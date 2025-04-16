<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempahans', function (Blueprint $table) {
            // Define the columns for the new 'tempahans' table
            $table->id();  // Add the primary key (id)
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
            $table->timestamps();  // Add timestamps (created_at and updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempahans');  // Drop the 'tempahans' table if rolling back
    }
}
