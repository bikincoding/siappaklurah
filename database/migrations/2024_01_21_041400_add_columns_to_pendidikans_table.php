<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendidikans', function (Blueprint $table) {
            $table->string('tingkatan_pendidikan');
            $table->integer('laki_laki')->unsigned();
            $table->integer('perempuan')->unsigned();
            $table->integer('id_laporan_bulan_tahuns')->unsigned();
            $table->integer('id_banjars')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendidikans', function (Blueprint $table) {
            $table->dropColumn(['tingkatan_pendidikan', 'laki_laki', 'perempuan', 'id_laporan_bulan_tahuns', 'id_banjars']);
        });
    }
}
