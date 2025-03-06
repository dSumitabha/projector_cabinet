<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'packaging_product_id',
        'package_s_no',
        'length_of_package',
        'width_of_package',
        'depth_of_package',
        'weight_of_package',
    ];
}
