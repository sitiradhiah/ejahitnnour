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
            // Add the missing columns
            $table->string('nama_pelanggan')->nullable();
            $table->string('jenis_tempahan')->nullable();
            $table->date('tarikh_tempahan')->nullable();
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
            // Drop the added columns in case of rollback
            $table->dropColumn(['nama_pelanggan', 'jenis_tempahan', 'tarikh_tempahan']);
        });
    }
}
