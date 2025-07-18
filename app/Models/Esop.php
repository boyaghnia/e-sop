<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class esop extends Model
{
    use HasFactory;

    protected $table = 'esops';

    protected $fillable = [
        'id_unor',
        'user_id',
        'judul_sop',
        'no_sop',
        'nama_sop',
        'tgl_ditetapkan',
        'tgl_revisi',
        'tgl_diberlakukan',
        'dasar_hukum',
        'kualifikasi_pelaksana',
        'keterkaitan',
        'peralatan_perlengkapan',
        'peringatan',
        'pencatatan_pendataan',
        'cara_mengatasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelaksanas()
    {
        return $this->hasMany(PelaksanaSop::class);
    }

    public function flows()
    {
        return $this->hasMany(Flow::class);
    }
    

    // Relasi ke tabel users
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'nip', 'nip');
    // }
}
