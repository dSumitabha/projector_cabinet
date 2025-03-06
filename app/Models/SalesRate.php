<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRate extends Model
{
    use HasFactory;
    protected $fillable = ['rate'];
}
