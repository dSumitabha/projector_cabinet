<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Adding new fields
            $table->string('profile')->nullable();
            $table->string('size')->nullable();
            $table->string('has_doors')->nullable();
            $table->string('color')->nullable();
            $table->string('diy')->nullable();
            $table->string('total_sheets')->nullable();
            $table->string('on_sided_sheets')->nullable();
            $table->string('two_sided_sheets')->nullable();
            $table->decimal('profit_percentage', 8, 2)->nullable()->change();
            $table->decimal('length_of_cabinet', 8, 2)->nullable();
            $table->decimal('height_of_cabinet', 8, 2)->nullable();
            $table->decimal('depth_of_cabinet', 8, 2)->nullable();

            // Drop any unwanted columns


          


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Revert the changes if you rollback the migration


            // Restore dropped columns


        });
    }
}
