<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_products', function (Blueprint $table) {
            $table->id();
            $table->string('packaging_product_id');
            $table->string('package_s_no');
            $table->decimal('length_of_package', 8, 2)->nullable();
            $table->decimal('width_of_package', 8, 2)->nullable();
            $table->decimal('depth_of_package', 8, 2)->nullable();
            $table->decimal('weight_of_package', 8, 2)->nullable();
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
        Schema::dropIfExists('package_products');
    }
}
