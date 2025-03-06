<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulationImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulation_images', function (Blueprint $table) {
            $table->id();
            $table->string('parent_product_id');
            $table->string('projector_make');
            $table->string('screen_size');
            $table->string('ceiling_height');
            $table->string('center_channel_height');
            $table->string('image_name');
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
        Schema::dropIfExists('simulation_images');
    }
}
