<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLayoutIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('packaging_product_id')->nullable();
            $table->string('layout_id')->nullable();
            $table->string('off_wall')->nullable();
            $table->string('floor_raising_screen')->nullable();
            $table->string('depth_of_middle_section')->nullable();
            $table->string('depth_of_side_sections')->nullable();
            $table->string('center_channel_chamber_length')->nullable();
            $table->string('center_channel_chamber_depth')->nullable();
            $table->string('center_channel_chamber_height')->nullable();
            $table->string('compatable_with_projectors')->nullable();
            $table->string('compatable_with_center_channels')->nullable();
            $table->string('center_channel_placement')->nullable();
            $table->string('variable_height_projector_platform')->nullable();
            $table->string('variable_height_center_channel_platform')->nullable();
            $table->string('variable_depth_center_channel_platform')->nullable();
            $table->string('angling_mechanism_for_center_channel')->nullable();
            $table->string('enclosed_ust_projector')->nullable();
            $table->string('enclosed_center_channel')->nullable();
            $table->string('open_back_design')->nullable();
            $table->string('silent_fan_for_flushing_heat_from_avr')->nullable();
            $table->string('adjustable_height_legs')->nullable();
            $table->string('remote_friendly')->nullable();
            $table->string('off_wall_cabinet')->nullable();
            $table->string('is_floor_raising_screen_embedded_within_cabinet')->nullable();
            $table->string('material')->nullable();
            $table->string('installation_required')->nullable();
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
            $table->dropColumn('packaging_product_id');
            $table->dropColumn('layout_id');
            $table->dropColumn('off_wall');
            $table->dropColumn('floor_raising_screen');
            $table->dropColumn('depth_of_middle_section');
            $table->dropColumn('depth_of_side_sections');
            $table->dropColumn('center_channel_chamber_length');
            $table->dropColumn('center_channel_chamber_depth');
            $table->dropColumn('center_channel_chamber_height');
            $table->dropColumn('compatable_with_projectors');
            $table->dropColumn('compatable_with_center_channels');
            $table->dropColumn('center_channel_placement');
            $table->dropColumn('variable_height_projector_platform');
            $table->dropColumn('variable_height_center_channel_platform');
            $table->dropColumn('variable_depth_center_channel_platform');
            $table->dropColumn('angling_mechanism_for_center_channel');
            $table->dropColumn('enclosed_ust_projector');
            $table->dropColumn('enclosed_center_channel');
            $table->dropColumn('open_back_design');
            $table->dropColumn('silent_fan_for_flushing_heat_from_avr');
            $table->dropColumn('adjustable_height_legs');
            $table->dropColumn('remote_friendly');
            $table->dropColumn('off_wall_cabinet');
            $table->dropColumn('is_floor_raising_screen_embedded_within_cabinet');
            $table->dropColumn('material');
            $table->dropColumn('installation_required');
        });
    }
}
