<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('flows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('esop_id')->constrained()->onDelete('cascade');
            $table->integer('no_urutan')->default(0);
            $table->text('uraian_kegiatan');
            $table->text('kelengkapan')->nullable();
            $table->text('waktu')->nullable();
            $table->text('output')->nullable();
            $table->text('keterangan')->nullable();
            $table->json('symbols')->nullable();
            $table->json('return_to')->nullable();
            $table->json('connect_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flows');
    }
};
