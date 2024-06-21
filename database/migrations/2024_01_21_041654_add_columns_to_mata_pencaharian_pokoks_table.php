<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMataPencaharianPokoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mata_pencaharian_pokoks', function (Blueprint $table) {
            $table->string('jenis_pekerjaan');
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
        Schema::table('mata_pencaharian_pokoks', function (Blueprint $table) {
            $table->dropColumn(['jenis_pekerjaan', 'laki_laki', 'perempuan', 'id_laporan_bulan_tahuns', 'id_banjars']);
        });
    }
}
