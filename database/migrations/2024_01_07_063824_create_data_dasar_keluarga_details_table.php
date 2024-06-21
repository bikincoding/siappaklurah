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
        Schema::create('data_dasar_keluarga_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_data_dasar_keluargas');
            $table->string('nama');
            $table->string('jenis_kelamin', 1)->comment('L untuk Laki-laki, P untuk Perempuan');
            $table->string('hubungan_dengan_kepala_keluarga');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('status_perkawinan');
            $table->string('agama');
            $table->string('golongan_darah', 2);
            $table->string('kewarganegaraan', 3);
            $table->string('etnis_suku');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('id_data_dasar_keluargas')->references('id')->on('data_dasar_keluargas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_dasar_keluarga_details');
    }
};
