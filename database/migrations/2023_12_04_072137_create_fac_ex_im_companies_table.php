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
        Schema::create('fac_ex_im_companies', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('TaxCard');
            $table->string('CommercialRecord');
            $table->string('IndustrialRecord');
            $table->string('Website');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fac_ex_im_companies');
    }
};
