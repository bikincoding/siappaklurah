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
        Schema::create('sumber_daya_manusias', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_laki_laki');
            $table->integer('jumlah_perempuan');
            $table->integer('jumlah_total');
            $table->integer('jumlah_kepala_keluarga');
            $table->integer('kepadatan_penduduk');
            $table->integer('id_laporan_bulan_tahuns');
            $table->integer('id_banjars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_daya_manusias');
    }
};
