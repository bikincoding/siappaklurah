<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToKewarganegaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kewarganegaraans', function (Blueprint $table) {
            $table->string('kewarganegaraan');
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
        Schema::table('kewarganegaraans', function (Blueprint $table) {
            $table->dropColumn(['kewarganegaraan', 'laki_laki', 'perempuan', 'id_laporan_bulan_tahuns', 'id_banjars']);
        });
    }
}
