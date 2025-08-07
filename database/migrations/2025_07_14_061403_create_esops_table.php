<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

    Schema::create('esops', function (Blueprint $table) {
        $table->id();
        $table->string('id_unor');
        $table->foreign('id_unor')->references('id_unor')->on('users')->onDelete('cascade'); // Relasi ke users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('judul_sop')->nullable();
        $table->string('no_sop')->nullable();
        $table->string('nama_sop')->nullable();
        $table->string('tgl_ditetapkan')->nullable();
        $table->string('tgl_revisi')->nullable();
        $table->string('tgl_diberlakukan')->nullable();
        $table->text('dasar_hukum')->nullable();
        $table->text('kualifikasi_pelaksana')->nullable();
        $table->text('keterkaitan')->nullable();
        $table->text('peralatan_perlengkapan')->nullable();
        $table->text('peringatan')->nullable();
        $table->text('pencatatan_pendataan')->nullable();
        $table->text('cara_mengatasi')->nullable();
        $table->string('file_path')->nullable();
        $table->string('file_name')->nullable();
        $table->string('status')->nullable()->default('Draft');
        $table->timestamps();
    });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esops');
    }
};
