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
        Schema::table('posts', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['ingredient_list_id']);

            // Now drop the column
            $table->dropColumn('ingredient_list_id');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('ingredient_list_id')->nullable();

            // Add the foreign key back if needed
            $table->foreign('ingredient_list_id')->references('id')->on('ingredient_lists')->onDelete('cascade');
        });
    }


};
