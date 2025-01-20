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
    Schema::table('ingredients', function (Blueprint $table) {
        if (!Schema::hasColumn('ingredients', 'ingredient_list_id')) {
            $table->unsignedBigInteger('ingredient_list_id');
        }
    });
}


public function down()
{
    Schema::table('ingredients', function (Blueprint $table) {
        $table->dropForeign(['ingredient_list_id']);
        $table->dropColumn('ingredient_list_id');
    });
}

};
