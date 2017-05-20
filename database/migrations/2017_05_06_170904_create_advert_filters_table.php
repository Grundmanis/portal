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
    {  Schema::create('advert_filters', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('advert_id')->unsigned();
        $table->integer('filter_id')->unsigned();
        $table->timestamps();
        $table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade');
        $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');
    });

        Schema::create('advert_filter_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('advert_filter_id')->unsigned();
            $table->text('value');

            $table->string('locale')->index();
            $table->unique(['advert_filter_id','locale']);
            $table->foreign('advert_filter_id')->references('id')->on('advert_filters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advert_filter_translations');
        Schema::dropIfExists('advert_filters');
    }
}
