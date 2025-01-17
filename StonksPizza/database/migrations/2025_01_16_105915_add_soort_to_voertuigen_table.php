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
        Schema::table('voertuigen', function (Blueprint $table) {
            // Voeg een kolom toe voor "soort" (kan auto, fiets, brommer, enz. zijn)
            // Of gebruik enum() als je vaste keuzes wilt
            $table->string('soort')->nullable()->after('kenteken');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voertuigen', function (Blueprint $table) {
            //
        });
    }
};
