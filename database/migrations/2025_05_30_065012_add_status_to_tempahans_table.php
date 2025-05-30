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
            $table->string('status')->default('Dalam Pelaksanaan'); // Menambah kolum status dengan nilai default
        });
    }

    public function down()
    {
        Schema::table('tempahans', function (Blueprint $table) {
            $table->dropColumn('status'); // Buang kolum status sekiranya migration dibatalkan
        });
    }

};
