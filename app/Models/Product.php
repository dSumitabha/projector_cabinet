<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'gs1',
        'gs1_type',
        'parent_product_id',
        'product_id',
        'packaging_product_id',        // New field
        'layout_id',                    // New field
        'product_frontend_name',
        'product_frontend_description',
        'product_name',
        'profile',
        'size',
        'has_doors',
        'color',
        'diy',
        'off_wall',                     // New field
        'floor_raising_screen',         // New field
        'product_type',
        'length_of_cabinet',
        'height_of_cabinet',
        'depth_of_cabinet',
        'depth_of_middle_section',     // New field
        'depth_of_side_sections',      // New field
        'center_channel_chamber_length',  // New field
        'center_channel_chamber_depth',   // New field
        'center_channel_chamber_height',  // New field
        'profit_percentage',
        'profit_margin',
        'selling_price',
        'compatable_with_projectors',  // New field
        'compatable_with_center_channels', // New field
        'center_channel_placement',    // New field
        'variable_height_projector_platform',  // New field
        'variable_height_center_channel_platform', // New field
        'variable_depth_center_channel_platform', // New field
        'angling_mechanism_for_center_channel', // New field
        'enclosed_ust_projector',      // New field
        'enclosed_center_channel',     // New field
        'open_back_design',            // New field
        'silent_fan_for_flushing_heat_from_avr', // New field
        'adjustable_height_legs',      // New field
        'remote_friendly',             // New field
        'off_wall_cabinet',            // New field
        'is_floor_raising_screen_embedded_within_cabinet', // New field
        'material',                    // New field
        'fusion_id',
        'render_id',
        'product_center_channel_placement',
        'installation_required'        // New field
    ];
    public function productImages()
    {
        return $this->hasMany(ProductImage::class,'product_id','product_id');
    }
    public function associatedProducts()
    {
        return $this->hasMany(ProductAssociated::class, 'parent_product_id', 'parent_product_id');
    }
    public function associatedProduct()
{
    return $this->hasOne(ProductAssociated::class, 'parent_product_id', 'parent_product_id');
}
}
