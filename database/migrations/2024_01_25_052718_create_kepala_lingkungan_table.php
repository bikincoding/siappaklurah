<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepalaLingkunganTable extends Migration
{
    public function up()
    {
        Schema::create('kepala_lingkungan', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('nama_kepala_lingkungan');
            $table->string('alamat');
            $table->integer('id_banjars');
            $table->string('telepon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kepala_lingkungan');
    }
}
