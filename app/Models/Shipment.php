<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'carrier', 'service', 'tracking_number', 'tracking_url', 'label_url', 'shipping_cost', 'currency', 'estimated_delivery'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
