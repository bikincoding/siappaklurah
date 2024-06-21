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
        Schema::table('users', function (Blueprint $table) {
            // Pastikan Anda sudah memiliki tabel 'banjars' sebelum membuat keterkaitan kunci asing
            $table->unsignedBigInteger('id_banjars')->nullable()->after('id'); // Menambahkan setelah kolom 'id'
            $table->foreign('id_banjars')->references('id')->on('banjars')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_banjars']); // Menghapus keterkaitan kunci asing terlebih dahulu
            $table->dropColumn('id_banjars'); // Kemudian menghapus kolomnya
        });
    }
};
