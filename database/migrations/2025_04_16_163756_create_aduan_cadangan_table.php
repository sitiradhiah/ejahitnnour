<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {   
        Schema::create('aduan_cadangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('tajuk');
            $table->string('kategori');
            $table->date('tarikh');
            $table->string('status')->default('Menunggu');
            $table->text('message');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduan_cadangan');
    }
};
