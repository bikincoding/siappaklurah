<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCacatMentalFisiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cacat_mental_fisiks', function (Blueprint $table) {
            $table->string('jenis_cacat')->after('id');
            $table->integer('laki_laki')->unsigned()->after('jenis_cacat');
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
        Schema::table('cacat_mental_fisiks', function (Blueprint $table) {
            $table->dropColumn(['jenis_cacat', 'laki_laki', 'perempuan', 'id_laporan_bulan_tahuns', 'id_banjars']);
        });
    }
}
