<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoicetempahan', function (Blueprint $table) {
            $table->increments('idinvoice');
            $table->unsignedInteger('idtempahan');
            $table->dateTime('tarikh');
            $table->string('catatan')->nullable(); // Make nullable if it's optional
            $table->double('hargaPerTempahan', 8, 2); // 8 digits total, 2 decimal places

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoicetempahan');
    }
};
