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
        Schema::create('clients', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('Name');
            $table->string('Password');
            $table->string('SSN')->nullable();
            $table->string('Email')->unique();
            $table->string('PhoneNumber');
            $table->string('Nationality')->nullable();
            $table->string('Photo')->nullable();
            $table->string('Address')->nullable();
            $table->string('TaxCard')->nullable();
            $table->string('CommercialRecord')->nullable();
            $table->string('IndustrialRecord')->nullable();
            $table->string('CountryDealing')->nullable();
            $table->string('CountryTarget')->nullable();
            $table->string('Website')->nullable();
            $table->string('TypeOfClient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
