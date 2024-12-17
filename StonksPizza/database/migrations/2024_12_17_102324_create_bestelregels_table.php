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
        Schema::create('bestelregels', function (Blueprint $table) {
            $table->id();
            $table->integer('aantal');
            $table->string('afmeting');
            $table->foreignId('pizza_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bestelling_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bestelregels');
    }
};
