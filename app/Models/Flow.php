<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    protected $fillable = [
        'esop_id', 
        'no_urutan',
        'uraian_kegiatan', 
        'kelengkapan', 
        'waktu', 
        'output', 
        'keterangan'
    ];
}
