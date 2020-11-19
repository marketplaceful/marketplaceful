<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->text('feature_image_path')->nullable();
            $table->json('photo_paths')->nullable();
            $table->text('location_coordinates')->nullable();
            $table->point('location_geometry', 4326)->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status', 50)->default('draft');
            $table->schemalessAttributes('public_metadata');
            $table->schemalessAttributes('private_metadata');
            $table->schemalessAttributes('internal_metadata');
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('listings');
    }
}
