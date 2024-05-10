<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->decimal('rate', 2, 1);
            $table->unsignedBigInteger('shipping_company_id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('shipping_company_id')->references('id')->on('shipping_companies')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
