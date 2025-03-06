<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'part_id',
        'part_name',
        'part_type',
        'rate',
        'total_hours_units',
        'unit_cost',
        'percentage_used',
        'total',
    ];

    protected static function boot()
    {
        parent::boot();

        // Listen for the "deleted" event on ProductPart
        static::deleted(function ($productPart) {
            // Fetch the related product
            $product = $productPart->product;

            // Calculate the total cost from all remaining ProductParts related to this product
            $totalCostPrice = ProductPart::where('product_id', $product->product_id)->sum('total');

            // Update the cost_price for the product
            $product->cost_price = $totalCostPrice > 0 ? $totalCostPrice : 0;

            // Recalculate the selling price if profit_percentage exists
            if ($product->cost_price && $product->profit_percentage) {
                $product->selling_price = round(
                    $product->cost_price + ($product->cost_price * $product->profit_percentage / 100),
                    2
                );
            } else {
                $product->selling_price = null;
            }

            // Save the updated product
            $product->save();
        });
    }

   
}
