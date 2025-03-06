<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FusionFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'fusion_id',
        'file_name',
        'file_attachment',
    ];
}
