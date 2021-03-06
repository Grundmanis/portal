<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('category_parent_id')->unsigned()->nullable();
            $table->string('type');
            $table->boolean('in_filters')->nullable();
            $table->boolean('in_adverts_list')->nullable();
            $table->boolean('in_all_categories')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('category_parent_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('filter_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('filter_id')->unsigned();
            $table->string('name');
            $table->string('value')->nullable();

            $table->string('locale')->index();
            $table->unique(['filter_id','locale']);
            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_translations');
        Schema::dropIfExists('filters');
    }
}
