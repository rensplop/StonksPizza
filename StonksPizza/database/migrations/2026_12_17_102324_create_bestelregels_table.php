<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bestelregels', function (Blueprint $table) {
            $table->id();
            $table->integer('aantal');
            $table->string('afmeting');
            $table->unsignedBigInteger('pizza_id');      // verwijst naar je pizzas-tabel
            $table->unsignedBigInteger('bestelling_id'); // verwijst naar bestellingen-tabel
            $table->timestamps();


            $table->foreign('pizza_id')
                  ->references('id')
                  ->on('pizzas')
                  ->onDelete('cascade');

            $table->foreign('bestelling_id')
                  ->references('id')
                  ->on('bestellingen')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bestelregels');
    }
};
