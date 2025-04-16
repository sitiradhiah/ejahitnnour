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
            // Adding new columns to the existing 'tempahans' table
            $table->string('alamat')->nullable();
            $table->string('nombor_telefon')->nullable();
            $table->integer('chest_size')->nullable();
            $table->integer('waist_size')->nullable();
            $table->integer('shoulder_width')->nullable();
            $table->integer('sleeve_length')->nullable();
            $table->string('jenis_kain')->nullable();
            $table->string('warna_kain')->nullable();
            $table->string('size')->nullable();
            $table->decimal('harga_tempahan', 10, 2)->nullable();
            $table->text('additional_notes')->nullable();
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
            // Dropping the columns in case of rollback
            $table->dropColumn([
                'alamat',
                'nombor_telefon',
                'chest_size',
                'waist_size',
                'shoulder_width',
                'sleeve_length',
                'jenis_kain',
                'warna_kain',
                'size',
                'harga_tempahan',
                'additional_notes',
            ]);
        });
    }
}
