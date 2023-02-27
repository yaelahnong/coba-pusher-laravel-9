<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeTerkiniProvinsi extends Model
{
    use HasFactory;

    public $primaryKey = 'rtp_id';

    protected $table = 'r_terkini_provinsi';

    protected $fillable = [
        'rtp_kp_id',
        'rtp_mp_id',
        'rtp_jumlah_suara',
        'rtp_bulan',
        'rtp_tahun',
    ];

    public function getData()
    {
        return $this->selectRaw('
            rtp_id as id,
            rtp_kp_id as id_kandidat,
            rtp_jumlah_suara as jumlah_suara,
            mp_kode as kode_provinsi,
            mp_nama as provinsi
        ')
        ->joinMasterProvinsi()
        ->get();
    }

    public function updateJumlahSuaraByKode($kodeKandidat, $kodeProvinsi, $jumlahSuara)
    {
        $resume = $this->where('rtp_kp_kode', $kodeKandidat)
                        ->where('rtp_mp_kode', $kodeProvinsi)
                        ->first();

        $resumeId = $resume->rtp_id;

        $currentJumlahSuara = $resume->rtp_jumlah_suara;

        if ($jumlahSuara) {
            $resume->rtp_jumlah_suara = $resume->rtp_jumlah_suara + $jumlahSuara;
            
            $resume->save();
        }

        if ($resume->rtp_jumlah_suara > $currentJumlahSuara) {
            return [
                'id' => $resumeId,
                'jumlah_suara' => $resume->rtp_jumlah_suara,
            ];
        } else {
            return null;
        }

        
    }

    public function scopeJoinKandidatPemilihan($q)
    {
        return $q->join('kandidat_pemilihan', 'rtp_kp_id', '=', 'kp_id');
    }

    public function scopeJoinMasterProvinsi($q)
    {
        return $q->join('m_provinsi', 'rtp_mp_id', '=', 'mp_id');
    }
}
