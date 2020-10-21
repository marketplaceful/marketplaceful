<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('listings_tags', function (Blueprint $table) {
            $table->integer('listing_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->integer('order_column')->unsigned()->nullable();

            $table->unique(['listing_id', 'tag_id']);

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
