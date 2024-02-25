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
        Schema::create('requests', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
//            $table->foreignId('fac_ex_im_id')->references('id')->on('fac_ex_im_companies')->onDelete('cascade');
            $table->string('Location');
            $table->string('Destination');
            $table->string('Comment');
            $table->string('GoodsType');
            $table->string('Safety')->nullable();
            $table->integer('Weight')->nullable();
            $table->integer('Length')->nullable();
            $table->integer('Width')->nullable();
            $table->integer('Height')->nullable();
            $table->string('Range')->nullable();
            $table->string('Country')->nullable();
            $table->string('ExtraFees')->nullable();
            $table->string('PreferType')->nullable();
            $table->string('TypesOfTruck')->nullable();
            $table->string('WeightOfSingleCarton')->nullable();
            $table->string('ContainerTypeAndSize')->nullable();
            $table->string('NumberOfContainer')->nullable();
            $table->string('NumberOfCartons')->nullable();
            $table->string('TypeOfRequest'); // 1 DHL  // 2 International // 3 Local
            $table->string('TypeOfInternational')->nullable(); // Wild // Sea // Air
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
