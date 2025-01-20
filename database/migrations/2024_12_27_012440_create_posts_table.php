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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->decimal('estimated_budget', 10, 2);
            $table->integer('estimated_prep_time'); // in minutes
            $table->integer('estimated_cooking_duration'); // in minutes
            $table->integer('estimated_serving_size');
            $table->string('recipe_name');
            $table->string('cousine');
            $table->string('main_ingredient');
            $table->string('recipe_type');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ingredient_list_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ingredient_list_id')->references('id')->on('ingredient_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
