<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $fillable = [
        'part_id',
        'part_or_service_name',
        'part_type',
        'rate',
        'unit_cost',
        'url',
        'available_qty',
        'source_company',
        'delivery_time',
        'qty',
        'batch_cost',
        'sales_tax',
        'part_category',
        'part_dimensions_length',
        'part_dimensions_width',
        'part_dimensions_depth',
        'part_dimension_weight',
        'edge_banding_lf',
    ];
}
