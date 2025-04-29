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
        Schema::table('tempahans', function (Blueprint $table) {
            $table->string('jenis_tempahan')->nullable()->after('nombor_telefon');
            $table->date('tarikh_tempahan')->nullable()->after('jenis_tempahan');
        });
    }
    
    public function down()
    {
        Schema::table('tempahans', function (Blueprint $table) {
            $table->dropColumn(['jenis_tempahan', 'tarikh_tempahan']);
        });
    }
};
