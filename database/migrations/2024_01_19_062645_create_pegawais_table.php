<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('foto_pegawai')->nullable();
            $table->string('nama_pegawai');
            $table->string('nip')->unique();
            $table->string('jabatan');
            $table->string('pangkat_golongan');
            $table->text('alamat');
            $table->date('tgl_lahir');
            $table->string('no_ktp')->unique();
            $table->string('npwp')->unique()->nullable();
            $table->string('no_karpeg')->unique()->nullable();
            $table->string('no_rek')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('telp');
            $table->string('golongan_darah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}