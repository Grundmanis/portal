<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advert_id')->unsigned();
            $table->foreign('advert_id')->references('id')->on('adverts');
            $table->integer('filter_id')->unsigned();
            $table->foreign('filter_id')->references('id')->on('category_filters');
            $table->text('key');
            $table->text('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advert_filters');
    }
}
