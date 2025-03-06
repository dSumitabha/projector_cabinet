<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('parent_product_id');
            $table->string('parent_product_name');
            $table->string('product_id');
            $table->string('product_name');
            $table->string('product_type');
            $table->string('gs1')->nullable();
            $table->string('gs1_type')->nullable();
            $table->string('length')->nullable();
            $table->string('height')->nullable();
            $table->string('depth')->nullable();
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
        Schema::dropIfExists('products');
    }
}
