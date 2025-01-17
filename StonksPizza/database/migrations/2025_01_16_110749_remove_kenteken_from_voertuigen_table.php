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
            $table->dropColumn('kenteken');
        });
    }
    
    public function down()
    {
        // Als je hem ooit wilt terugdraaien, kun je hier eventueel de kolom weer toevoegen
        Schema::table('voertuigen', function (Blueprint $table) {
            $table->string('kenteken')->nullable();
        });
    }
    
};
