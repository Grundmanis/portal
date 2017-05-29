<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDoubleFieldToFilters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filters', function (Blueprint $table) {
            $table->boolean('in_filters_double')->nullable();
            $table->dropForeign('category_id');
            $table->dropColumn('category_id');
            $table->dropForeign('category_parent_id');
            $table->dropColumn('category_parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filters', function (Blueprint $table) {
            $table->dropColumn('in_filters_double');
        });
    }
}
