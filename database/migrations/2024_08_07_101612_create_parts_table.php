<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('part_id')->unique();
            $table->string('part_name');
            $table->enum('part_type', ['Service', 'Physical']);
            $table->decimal('rate', 8, 2)->nullable();
            $table->decimal('unit_cost', 8, 2)->nullable();
            $table->string('source')->nullable();
            $table->integer('units_available')->nullable();
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
        Schema::dropIfExists('parts');
    }
}
