<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KandidatPemilihan extends Model
{
    use HasFactory;

    public $primaryKey = 'kp_id';

    protected $table = 'kandidat_pemilihan';

    protected $fillable = [
        'kp_nama',
        'kp_partai',
        'kp_foto_capres',
        'kp_foto_cawapres',
    ];

    public function getData()
    {
        return $this->selectRaw('
            kp_id as id,
            kp_kode as kode_kandidat,
            kp_nama as nama,
            kp_partai as partai,
            kp_foto_capres as foto_capres,
            kp_foto_cawapres as foto_cawapres
        ')
        ->get();
    }
}
