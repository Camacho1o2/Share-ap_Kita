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
    Schema::table('ingredient_lists', function (Blueprint $table) {
        $table->unsignedBigInteger('post_id')->nullable(); // nullable if it's not required initially
        $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('ingredient_lists', function (Blueprint $table) {
        $table->dropForeign(['post_id']);
        $table->dropColumn('post_id');
    });
}

};
