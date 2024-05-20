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
            $table->unsignedBigInteger('agents_id');
            $table->foreign('agents_id')->references('id')->on('agents')->onDelete('cascade');
            $table->unsignedBigInteger('request_id');
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
            $table->integer('Price');
            $table->string('PL');
            $table->string('TT');
            $table->string('FT');
            $table->string('OF');
            $table->string('THC');
            $table->string('From');
            $table->string('TO');
            $table->string('Comment')->nullable();
            $table->integer('ExtraFees');
            $table->string('PowerPerDay');
            $table->integer('CustomsPrice');
            $table->integer('TruckingPrice');
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
