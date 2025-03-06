<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAssociated extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_product_id',
        'projector_make',
        'projector_model',
        'screen_size',
        'ceiling_height',
        'center_channel_height',
        'simulated_center_channel',
        'center_channel_slot_from_bottom',
        'center_channel_tilt_slot',
        'center_channel_tilt_rod_lenth',
        'projector_platform_slot_from_bottom',
        'distance_of_cabinet_from_screen',
        'floor_raising_slot_from_bottom',
        'distance_of_projector_from_screen',
        'viewing_angle_sitting',
        'viewing_angle_reclining',
        'hearing_angle',
        'hearing_angle_reclining',
        'distance_of_top_section_of_screen_from_ceiling',
        'distance_of_bottom_section_of_the_screen_from_floor',
        'distance_of_floor_raising_screen_from_wall',
        'center_channel_l_clamp_position',
        'max_center_channel_height',
        'max_center_channel_length',
        'max_allowed_center_channel_depth',
        'center_channel_flag',
    ];
}
