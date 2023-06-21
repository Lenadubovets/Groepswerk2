<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIngredientUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredient_user', function (Blueprint $table) {
            $table->decimal('quantity_liters', 10, 2)->after('ingredient_id')->nullable();
            $table->decimal('quantity_grams', 10, 2)->after('quantity_liters')->nullable();
            $table->integer('quantity_pieces')->after('quantity_grams')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredient_user', function (Blueprint $table) {
            $table->dropColumn(['quantity_liters', 'quantity_grams', 'quantity_pieces']);
        });
    }
}
