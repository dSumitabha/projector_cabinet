<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssemblyPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'assembly_part_id',
        'part_id',
        'product_id',
        'packaging_product_id',
        'package_s_no',
        'qty'
    ];
    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id', 'part_id');
    }
}
