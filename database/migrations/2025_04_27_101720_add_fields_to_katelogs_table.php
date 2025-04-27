<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('katelogs', function (Blueprint $table) {
            $table->string('warna')->nullable();
            $table->string('saiz')->nullable();
            $table->decimal('harga', 8, 2)->nullable();
            $table->integer('stok')->nullable();
            $table->text('penerangan')->nullable();
        });
    }

    public function down()
    {
        Schema::table('katelogs', function (Blueprint $table) {
            $table->dropColumn(['warna', 'saiz', 'harga', 'stok', 'penerangan']);
        });
    }
};
