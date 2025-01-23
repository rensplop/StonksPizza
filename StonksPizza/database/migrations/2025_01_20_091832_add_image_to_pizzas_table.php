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
        Schema::table('pizzas', function (Blueprint $table) {
            $table->string('image')->nullable()->after('naam');
        });
    }
    
    public function down()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
    
};
