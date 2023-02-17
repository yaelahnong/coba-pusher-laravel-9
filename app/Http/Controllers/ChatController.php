<?php

namespace App\Http\Controllers;

use App\Events\PesanTerkirim;
use App\Models\PesanChat;
use App\Models\ResumePesanChat;
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
        $resumePesanChat = new ResumePesanChat();

        return view('chat', [
            'roomList' => $resumePesanChat->getUserChatRoomList(),
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

        $resumePesanChat = new ResumePesanChat();

        if ($resumePesanChat->roomNotFound($roomId)) {
            return null;
            // return redirect()->route('chat.show', $roomId)->with('error', 'Room not found');
        }

        if ($resumePesanChat->senderIsNotAuthorized($roomId)) {
            return null;
            // return redirect()->route('chat.show', $roomId)->with('error', 'Unauthorized sender');
        }

        DB::beginTransaction();

        try {
            $resumePesanChat->updateRoom($roomId, $validated['pesan']);
    
            $pesanChat = new PesanChat();
            
            $pesan = $pesanChat->storePesan($roomId, $validated['pesan']);

            DB::commit();

            broadcast(new PesanTerkirim($user, [
                'room_id' => $pesan['pc_room_id'],
                'user_initial' => $pesan['pc_user_initial'],
                'nama' => $pesan['pc_pesan'],
                'pesan' => $pesan['pc_pesan'],
                'created_at' => date('g:i A', strtotime($pesan['created_at'])),
            ], $roomId))->toOthers();

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
        $resumePesanChat = new ResumePesanChat();
        
        if ($resumePesanChat->roomNotFound($roomId)) {
            return redirect()->route('chat.show', $roomId)->with('error', 'Room not found');
        }

        if ($resumePesanChat->senderIsNotAuthorized($roomId)) {
            return redirect()->route('chat.show', $roomId)->with('error', 'Unauthorized sender');
        }

        $roomList = $resumePesanChat->getUserChatRoomList();

        $activeRoom = $resumePesanChat->findRoomByRoomId($roomId);

        $pesanChat = new PesanChat();

        $messageList = $pesanChat->getDataByRoomId($roomId);

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
