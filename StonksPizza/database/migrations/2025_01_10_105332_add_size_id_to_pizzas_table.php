<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropForeign(['size_id']);
            $table->dropColumn('size_id');
        });
    }
};
