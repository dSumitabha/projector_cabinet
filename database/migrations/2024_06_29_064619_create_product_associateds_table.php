<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAssociatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_associateds', function (Blueprint $table) {
            $table->id();
            $table->string('parent_product_id');
            $table->string('parent_product_name');
            $table->string('projector_make');
            $table->string('projector_model');
            $table->integer('slot_from_bottom')->nullable();
            $table->integer('screensize');
            $table->integer('screen_min')->nullable();
            $table->integer('screen_max')->nullable();
            $table->integer('ceiling_height_min')->nullable();
            $table->integer('distance_away_from_screen')->nullable();
            $table->integer('distance_of_bottom_section_of_the_screen_from_floor')->nullable();
            $table->text('viewing_angle')->nullable();
            $table->text('hearing_angle')->nullable();
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
        Schema::dropIfExists('product_associateds');
    }
}
