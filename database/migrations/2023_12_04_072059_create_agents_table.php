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
        Schema::create('agents', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('shipping_id');
            $table->foreign('shipping_id')->references('id')->on('shipping_companies')->onDelete('cascade');
            $table->string('Name');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('PhoneNumber')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
