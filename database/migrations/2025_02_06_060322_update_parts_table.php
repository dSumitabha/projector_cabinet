<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->renameColumn('part_name', 'part_or_service_name');
            $table->string('part_category')->nullable();
            $table->decimal('part_dimensions_length', 10, 2)->nullable();
            $table->decimal('part_dimensions_width', 10, 2)->nullable();
            $table->decimal('part_dimensions_depth', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->renameColumn('part_or_service_name', 'part_name');
            $table->dropColumn(['part_category', 'part_dimensions_length', 'part_dimensions_width', 'part_dimensions_depth']);
        });
    }
}
