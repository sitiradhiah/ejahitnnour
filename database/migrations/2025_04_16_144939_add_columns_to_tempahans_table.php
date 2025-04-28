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
        // Schema::table('tempahans', function (Blueprint $table) {
        //     $table->integer('ukuran_dada')->nullable();
        //     $table->integer('ukuran_pinggang')->nullable();
        //     $table->integer('lebar_bahu')->nullable();
        //     $table->integer('panjang_lengan')->nullable();
        //     // $table->string('jenis_kain')->nullable(); <-- KOMEN / PADAM LINE NI
        //     //$table->string('warna_kain')->nullable();
        //     $table->string('saiz')->nullable();
        //     $table->decimal('harga_tempahan', 8, 2)->nullable();
        //     $table->text('catatan_tambahan')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tempahans', function (Blueprint $table) {
        //     // Drop the columns that were added in the 'up' method
        //     $table->dropColumn([
        //         'ukuran_dada',
        //         'ukuran_pinggang',
        //         'lebar_bahu',
        //         'panjang_lengan',
        //         //'jenis_kain',
        //         //'warna_kain',
        //         'saiz',
        //         'harga_tempahan',
        //         'catatan_tambahan',
        //     ]);
        // });
    }
}
