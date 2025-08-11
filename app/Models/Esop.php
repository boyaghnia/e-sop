<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Esop extends Model
{
    use HasFactory;

    protected $table = 'esops';

    protected $fillable = [
        'id_uker',
        'user_id',
        'judul_sop',
        'no_sop',
        'nama_sop',
        'tgl_ditetapkan',
        'tgl_revisi',
        'tgl_diberlakukan',
        'ditetapkan_oleh',
        'dasar_hukum',
        'kualifikasi_pelaksana',
        'keterkaitan',
        'peralatan_perlengkapan',
        'peringatan',
        'pencatatan_pendataan',
        'cara_mengatasi',
        'file_path',
        'file_name',
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
