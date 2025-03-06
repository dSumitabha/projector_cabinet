<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductAssociatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_associateds', function (Blueprint $table) {
            $table->decimal('center_channel_height', 8, 2)->nullable();
            $table->string('simulated_center_channel')->default(false);
            $table->decimal('center_channel_l_clamp_position', 8, 2)->nullable();
            $table->decimal('max_center_channel_height', 8, 2)->nullable();
            $table->decimal('max_allowed_center_channel_depth', 8, 2)->nullable();
            $table->boolean('center_channel_flag')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_associateds', function (Blueprint $table) {
            $table->dropColumn([
                'center_channel_height',
                'simulated_center_channel',
                'center_channel_l_clamp_position',
                'max_center_channel_height',
                'max_allowed_center_channel_depth',
                'center_channel_flag'
            ]);
        });
    }
}
