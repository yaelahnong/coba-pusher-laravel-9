<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumePerbulanSeluruhIndonesia extends Model
{
    use HasFactory;

    public $primaryKey = 'rpsi_id';

    protected $table = 'r_perbulan_seluruh_indonesia';

    protected $fillable = [
        'rpsi_kp_id',
        'rpsi_jumlah_suara',
        'rpsi_bulan',
        'rpsi_tahun',
    ];
}
