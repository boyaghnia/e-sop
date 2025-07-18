<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelaksanaSop extends Model
{
    protected $fillable = ['esop_id', 'isi'];

    public function esop()
    {
        return $this->belongsTo(Esop::class);
    }
}