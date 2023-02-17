<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumePerbulanProvinsi extends Model
{
    use HasFactory;

    public $primaryKey = 'rpp_id';

    protected $table = 'r_perbulan_provinsi';

    protected $fillable = [
        'rpp_kp_id',
        'rpp_mp_id',
        'rpp_jumlah_suara',
        'rpp_bulan',
        'rpp_tahun',
    ];
}
