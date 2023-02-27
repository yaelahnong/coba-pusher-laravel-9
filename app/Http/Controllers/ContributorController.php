<?php

namespace App\Http\Controllers;

use App\Events\JumlahSuaraBertambah;
use Illuminate\Http\Request;

use App\Models\KandidatPemilihan;
use App\Models\ResumeTerkiniSeluruhIndonesia;
use App\Models\ResumeTerkiniProvinsi;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 2. Ambil data kandidat pemilihan
        $kandidatPemilihan = new KandidatPemilihan();
        $data['kandidat_pemilihan'] = $kandidatPemilihan->getData();

        // 3. Ambil data resume terkini per provinsi
        $resumeTerkiniProvinsi = new ResumeTerkiniProvinsi();
        $data['resume_terkini_provinsi'] = $resumeTerkiniProvinsi->getData();

        return view('contributor', [
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataInput = $request->all();
        
        unset($dataInput["_token"]);

        DB::beginTransaction();

        try {
            // TODO
            // 1. Split key ['kode_kandidat', 'kode_provinsi']
            // 2 Ambil nilai kode_kandidat
            // 3 Ambil nilai kode_provinsi
            // 4. Update overall resume kandidat menggunakan kode_kandidat
            // 5. Update resume kandidat per provinsi menggunakan kode_kandidat && kode_provinsi
            $resumeTerkiniSeluruhIndonesia = new ResumeTerkiniSeluruhIndonesia();
            
            $resumeTerkiniProvinsi = new ResumeTerkiniProvinsi();
            
            $resumeTerkiniSeluruhIndonesiaBaru = [];

            $resumeTerkiniProvinsiBaru = [];

            foreach($dataInput as $key => $jumlahSuara) {
                // 1. Split key ['kode_kandidat', 'kode_provinsi']
                $splittedKey = explode('-', $key);

                // 2. Ambil nilai kode_kandidat
                $kodeKandidat = $splittedKey[0];

                // 3. Ambil nilai kode_provinsi
                $kodeProvinsi = $splittedKey[1];
                
                // 4. Update overall resume kandidat menggunakan kode_kandidat
                $rtsi_id = $resumeTerkiniSeluruhIndonesia->updateJumlahSuaraByKode($kodeKandidat, $jumlahSuara);

                if ($rtsi_id !== null) {
                    $resumeTerkiniSeluruhIndonesiaBaru[] = $rtsi_id;
                }

                // 5. Update resume kandidat per provinsi menggunakan kode_kandidat && kode_provinsi
                $rtp_id = $resumeTerkiniProvinsi->updateJumlahSuaraByKode($kodeKandidat, $kodeProvinsi, $jumlahSuara);

                if ($rtp_id !== null) {
                    $resumeTerkiniProvinsiBaru[] = $rtp_id;
                }
            };

            DB::commit();

            // payload pertama untuk resume_terkini_seluruh_indonesia
            // "id": 1,
            // "nama": "Ir. H. JOKO WIDODO - KH. MA’RUF AMIN",
            // "partai": "PDI-P",
            // "foto_capres": "kandidat/1-small.jpeg",
            // "foto_cawapres": "kandidat/1-1-small.jpeg",
            // "jumlah_suara": 0

            // payload kedua untuk resume_terkini_provinsi
            // id": 1,
            // "id_kandidat": 1,
            // "jumlah_suara": 0,
            // "kode_provinsi": "dki",
            // "provinsi": "DKI JAKARTA"

            JumlahSuaraBertambah::dispatch(
                $resumeTerkiniSeluruhIndonesiaBaru,
                $resumeTerkiniProvinsiBaru
            );

            return redirect()->route('contributor.create')->with('success', 'Data jumlah suara berhasil ditambahkan');
        } catch (QueryException $err) {
            DB::rollBack();

            Log::error('server err', ['res' => $err]);
            
            return redirect()->route('contributor.create')->with('error', 'Server error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
