<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeTerkiniSeluruhIndonesia extends Model
{
    use HasFactory;

    public $primaryKey = 'rtsi_id';
    
    protected $table = 'r_terkini_seluruh_indonesia';

    protected $fillable = [
        'rtsi_kp_id',
        'rtsi_jumlah_suara',
        'rtsi_bulan',
        'rtsi_tahun',
    ];

    public function getData()
    {
        return $this->selectRaw('
            kp_id as id,
            kp_nama as nama,
            kp_partai as partai,
            kp_foto_capres as foto_capres,
            kp_foto_cawapres as foto_cawapres,
            rtsi_jumlah_suara as jumlah_suara
        ')
        ->joinKandidatPemilihan()
        ->get();
    }

    public function updateJumlahSuaraByKode($kodeKandidat, $jumlahSuara)
    {
        $resume = $this->where('rtsi_kp_kode', $kodeKandidat)->first();

        $resumeId = $resume->rtsi_id;

        $currentJumlahSuara = $resume->rtsi_jumlah_suara;

        if ($jumlahSuara) {
            $resume->rtsi_jumlah_suara = $resume->rtsi_jumlah_suara + $jumlahSuara;
            
            $resume->save();
        }

        if ($resume->rtsi_jumlah_suara > $currentJumlahSuara) {
            return [
                'id' => $resumeId,
                'jumlah_suara' => $resume->rtsi_jumlah_suara,
            ];
        } else {
            return null;
        }

    }

    public function scopeJoinKandidatPemilihan($q)
    {
        return $q->join('kandidat_pemilihan', 'rtsi_kp_id', '=', 'kp_id');
    }
}
