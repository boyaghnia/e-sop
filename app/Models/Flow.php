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
        'keterangan',
        'symbols',
        'return_to',
        'connect_to'
    ];

    protected $casts = [
        'symbols' => 'array',
        'return_to' => 'array',
        'connect_to' => 'array'
    ];
}
