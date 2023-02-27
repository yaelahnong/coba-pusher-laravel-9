<?php

namespace App\Http\Controllers;

use App\Events\PesanTerkirim;
use App\Models\Message;
use App\Models\Inbox;
use App\Models\InboxParticipant;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partisipanPesanChat = new InboxParticipant();

        return view('chat', [
            'roomList' => $partisipanPesanChat->getUserChatRoomList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $roomId)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'pesan' => 'required',
        ]);

        $resumePesanChat = new Inbox();
        $partisipanPesanChat = new InboxParticipant();

        if ($resumePesanChat->roomNotFound($roomId)) {
            return null;
            // return redirect()->route('chat.show', $roomId)->with('error', 'Room not found');
        }

        if ($partisipanPesanChat->senderIsNotAuthorized($roomId)) {
            return null;
            // return redirect()->route('chat.show', $roomId)->with('error', 'Unauthorized sender');
        }

        DB::beginTransaction();

        try {
            $resumePesanChat->updateRoom($roomId, $validated['pesan']);
    
            $pesanChat = new Message();

            $messagePayload = [
                'inbox_uid' => $roomId,
                'user_id' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'pesan' => $validated['pesan'],
                'pesan_created_at' => date('g:i A', strtotime(now())),
            ];
            
            $pesanChat->storePesan($messagePayload);

            DB::commit();

            PesanTerkirim::dispatch($user, $messagePayload, $roomId, $request->userIdPenerima);

            // broadcast(new PesanTerkirim($user, [
            //     'inbox_uid' => $pesan['ms_in_id'],
            //     'user_id' => $pesan['ms_user_id'],
            //     'nama' => $pesan['ms_user_name'],
            //     'pesan' => $pesan['ms_message'],
            //     'created_at' => $pesan['ms_message_time'],
            // ], $roomId));

            // PesanTerkirim::dispatch($user, [
            //     'inbox_uid' => $pesan['ms_in_id'],
            //     'user_id' => $pesan['ms_user_id'],
            //     'nama' => $pesan['ms_user_name'],
            //     'pesan' => $pesan['ms_message'],
            //     'pesan_created_at' => $pesan['ms_message_time'],
            // ], $roomId, $request->userIdPenerima);

            return redirect()->route('chat.show', $roomId);
        } catch (QueryException $err) {
            DB::rollBack();

            Log::error('ChatController::store', ['res' => $err]);

            // return redirect()->route('chat.show', $roomId)->with('error', 'Server error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($roomId)
    {
        $resumePesanChat = new Inbox();

        $partisipanPesanChat = new InboxParticipant();
        
        if ($resumePesanChat->roomNotFound($roomId)) {
            return redirect()->route('chat.show', $roomId)->with('error', 'Room not found');
        }

        if ($partisipanPesanChat->senderIsNotAuthorized($roomId)) {
            return redirect()->route('chat.show', $roomId)->with('error', 'Unauthorized sender');
        }

        $roomList = $partisipanPesanChat->getUserChatRoomList();

        $activeRoom = $partisipanPesanChat->findRoomByRoomId($roomId);

        $pesanChat = new Message();

        $messageList = $pesanChat->getMessagesByRoomId($roomId);

        return view('chat', [
            'roomList' => $roomList,
            'messageList' => $messageList,
            'activeRoom' => $activeRoom,
            'roomId' => $roomId,
            'currUser' => Auth::user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
