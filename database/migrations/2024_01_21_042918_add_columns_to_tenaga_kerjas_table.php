<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTenagaKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenaga_kerjas', function (Blueprint $table) {
            $table->string('tenaga_kerja')->after('id');
            $table->integer('laki_laki')->unsigned()->after('tenaga_kerja');
            $table->integer('perempuan')->unsigned()->after('laki_laki');
            $table->integer('id_laporan_bulan_tahuns')->unsigned()->after('perempuan');
            $table->integer('id_banjars')->unsigned()->after('id_laporan_bulan_tahuns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenaga_kerjas', function (Blueprint $table) {
            $table->dropColumn(['tenaga_kerja', 'laki_laki', 'perempuan', 'id_laporan_bulan_tahuns', 'id_banjars']);
        });
    }
}
