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
        Schema::create('shipping_companies', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('Name');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('Address');
            $table->string('Website');
            $table->string('BuisinessHistory');
            $table->string('BuisinessHours');
            $table->string('PhoneNumber')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_companies');
    }
};
