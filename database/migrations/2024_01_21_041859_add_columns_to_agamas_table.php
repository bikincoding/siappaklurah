<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAgamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agamas', function (Blueprint $table) {
            $table->string('agama');
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
        Schema::table('agamas', function (Blueprint $table) {
            $table->dropColumn(['agama', 'laki_laki', 'perempuan', 'id_laporan_bulan_tahuns', 'id_banjars']);
        });
    }
}
