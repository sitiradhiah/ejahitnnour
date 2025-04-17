<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTempahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tempahans', function (Blueprint $table) {
            // Add new columns to the tempahans table
            $table->integer('ukuran_dada')->nullable(); // Ukuran Dada (cm)
            $table->integer('ukuran_pinggang')->nullable(); // Ukuran Pinggang (cm)
            $table->integer('lebar_bahu')->nullable(); // Lebar Bahu (cm)
            $table->integer('panjang_lengan')->nullable(); // Panjang Lengan (cm)
            $table->string('jenis_kain')->nullable(); // Jenis Kain
            $table->string('warna_kain')->nullable(); // Warna Kain
            $table->string('saiz')->nullable(); // Saiz
            $table->decimal('harga_tempahan', 8, 2)->nullable(); // Harga Tempahan (RM)
            $table->text('catatan_tambahan')->nullable(); // Catatan Tambahan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tempahans', function (Blueprint $table) {
            // Drop the columns that were added in the 'up' method
            $table->dropColumn([
                'ukuran_dada',
                'ukuran_pinggang',
                'lebar_bahu',
                'panjang_lengan',
                'jenis_kain',
                'warna_kain',
                'saiz',
                'harga_tempahan',
                'catatan_tambahan',
            ]);
        });
    }
}
