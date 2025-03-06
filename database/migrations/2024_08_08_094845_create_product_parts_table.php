<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_parts', function (Blueprint $table) {
            $table->id();
            
            $table->string('product_id');
            $table->string('part_id');
            $table->string('part_name');
            $table->enum('part_type', ['Service', 'Physical']);
            $table->decimal('rate', 8, 2)->nullable();
            $table->integer('total_hours_units')->nullable();
            $table->decimal('unit_cost', 8, 2)->nullable();
            $table->integer('percentage_used')->nullable();
            $table->decimal('total', 8, 2);

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
        Schema::dropIfExists('product_parts');
    }
}
