<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectorMakeModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'make',
        'model',
    ];
}
