<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KandidatPemilihan;
use App\Models\ResumeTerkiniProvinsi;
use App\Models\ResumeTerkiniSeluruhIndonesia;

class PemiluController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO
        // 1. Ambil data resume terkini seluruh indonesia
        // 2. Ambil data kandidat
        // 3. Ambil data resume terkini per provinsi

        
        // 1. Ambil data resume terkini seluruh indonesia
        $resumeTerkiniSeluruhIndonesia = new ResumeTerkiniSeluruhIndonesia();
        $data['resume_terkini_seluruh_indonesia'] = $resumeTerkiniSeluruhIndonesia->getData();

        // 2. Ambil data kandidat pemilihan
        $kandidatPemilihan = new KandidatPemilihan();
        $data['kandidat_pemilihan'] = $kandidatPemilihan->getData();

        // 3. Ambil data resume terkini per provinsi
        $resumeTerkiniProvinsi = new ResumeTerkiniProvinsi();
        $data['resume_terkini_provinsi'] = $resumeTerkiniProvinsi->getData();
        
        $konten['meta_title'] = 'HASIL HITUNG SUARA PEMILU PRESIDEN & WAKIL PRESIDEN RI 2024 SELURUH INDONESIA';
        $konten['judul_utama'] = 'HASIL HITUNG SUARA PEMILU PRESIDEN & WAKIL PRESIDEN RI 2024 SELURUH INDONESIA';
        $konten['judul_per_provinsi'] = 'HASIL HITUNG SUARA PEMILU PRESIDEN & WAKIL PRESIDEN RI 2024 PER PROVINSI';
        $konten['jumlah_suara'] = 'Suara:';
        
        return view('index', [
            'konten' => $konten,
            'data' => $data,
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
    public function store(Request $request)
    {
        //
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
