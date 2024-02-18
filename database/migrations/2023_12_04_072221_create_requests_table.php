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
            $table->string('Destination');
            $table->string('Comment');
            $table->string('GoodsType');
            $table->string('Safety');
            $table->integer('Weight');
            $table->integer('Length');
            $table->integer('Width');
            $table->integer('Height');
            $table->string('Range');
            $table->string('Country');
            $table->string('ExtraFees');
            $table->string('PreferType');
            $table->string('TypesOfTruck');
            $table->string('WeightOfSingleCarton');
            $table->string('ContainerTypeAndSize');
            $table->string('NumberOfContainer');
            $table->string('NumberOfCartons');
            $table->string('Sender_id');
            $table->string('Agent_id');
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
