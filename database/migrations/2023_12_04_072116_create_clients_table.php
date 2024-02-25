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
        Schema::create('clients', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('Name');
            $table->string('Password');
            $table->string('SSN');
            $table->string('Email')->unique();
            $table->string('PhoneNumber');
            $table->string('Nationality');
            $table->string('Photo');
            $table->string('Address');
            $table->string('TaxCard')->nullable();
            $table->string('CommercialRecord');
            $table->string('IndustrialRecord');
            $table->string('CountryDealing');
            $table->string('CountryTarget');
            $table->string('Website');
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
