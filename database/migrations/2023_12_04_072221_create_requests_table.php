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
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('Location');
            $table->string('Destination');
            $table->string('Location2');
            $table->string('Destination2');
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
            $table->integer('ACCEPT')->nullable();
            $table->integer('ACCEPT_ID')->nullable();
            $table->integer('DONE')->nullable();
            $table->integer('BestCase')->nullable();
            $table->integer('CustomsClearness')->nullable();
            $table->integer('Tracking')->nullable();
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
