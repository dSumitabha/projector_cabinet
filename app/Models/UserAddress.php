<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table='user_address';

    protected $fillable = [
        'user_id',
        'cookie_id',
        'street1',
        'city',
        'state',
        'zip',
        'country',
        'phone',
        'email',
        'is_active',
    ];
}
