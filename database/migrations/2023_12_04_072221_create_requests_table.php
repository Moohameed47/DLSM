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
        Schema::create('requests', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('Location');
            $table->string('Distination');
            $table->string('Safety');
            $table->integer('Weight');
            $table->string('Range');
            $table->string('ExtraFees');
            $table->string('PreferType');
            $table->string('GoodsType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
