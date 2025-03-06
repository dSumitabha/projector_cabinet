<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_product_id',
        'projector_make',
        'screen_size',
        'ceiling_height',
        'center_channel_height',
        'image_name'
    ];
}
