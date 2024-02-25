<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('Price');
            $table->string('PL');
            $table->string('TT');
            $table->string('FT');
            $table->string('OF');
            $table->string('THC');
            $table->integer('ExtraFees');
            $table->string('PowerPerDay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
