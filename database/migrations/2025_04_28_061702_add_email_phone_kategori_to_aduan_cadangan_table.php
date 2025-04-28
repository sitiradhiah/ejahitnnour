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
        Schema::table('aduan_cadangan', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('no_telefon')->nullable();
            // $table->string('kategori')->default('Aduan'); --> BUANG line ni
        });
    }

    public function down()
    {
        Schema::table('aduan_cadangan', function (Blueprint $table) {
            $table->dropColumn(['email', 'no_telefon']);
            // $table->dropColumn('kategori'); --> Jangan buang kategori sebab dah memang ada
        });
    }


};
