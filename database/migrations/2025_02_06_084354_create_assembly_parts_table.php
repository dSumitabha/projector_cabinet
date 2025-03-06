<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssemblyPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assembly_parts', function (Blueprint $table) {
            $table->id();
            $table->string('assembly_part_id')->unique();
            $table->string('part_id');
            $table->string('product_id');
            $table->string('packaging_product_id');
            $table->string('package_s_no')->nullable();
            $table->string('qty')->nullable();
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
        Schema::dropIfExists('assembly_parts');
    }
}
