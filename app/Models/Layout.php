<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasFactory;
    protected $fillable = [
        'layout_id',
        'grain_no_grain',
        'layout_name',
        'file_attachment',
    ];
}
