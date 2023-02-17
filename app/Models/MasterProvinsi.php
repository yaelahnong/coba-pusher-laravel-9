<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProvinsi extends Model
{
    use HasFactory;

    public $primaryKey = 'mp_id';

    protected $table = 'm_provinsi';

    protected $fillable = [
        'mp_nama',
    ];
}
