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
        Schema::table('katelogs', function (Blueprint $table) {
            $table->dropColumn('stok');
        });
    }
    
    public function down()
    {
        Schema::table('katelogs', function (Blueprint $table) {
            $table->integer('stok')->nullable(); // You can change the type if needed
        });
    }
    
};
