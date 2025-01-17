<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoertuigsTable extends Migration
{

    public function up(): void
    {
        Schema::create('voertuigen', function (Blueprint $table) {
            $table->id();
            $table->string('naam');      
            $table->string('merk');       
            $table->string('kenteken');  
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('voertuigen');
    }
}
