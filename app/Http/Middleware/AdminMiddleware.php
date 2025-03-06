<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Product;
use App\Models\ProductPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user_type = Auth::user()->user_type;

            if ($user_type == 1) {
                $products = Product::all();

                foreach ($products as $product) {
                    // Fetch and sum up the total cost_price from ProductPart for the product
                    $totalCostPrice = ProductPart::where('product_id', $product->product_id)->sum('total');

                    // Update cost_price in Product model
                    if ($totalCostPrice > 0) {
                        $product->cost_price = $totalCostPrice;
                    }

                    // Calculate the selling price
                    if ($product->cost_price) {
                        if ($product->profit_margin) {
                            // If profit_margin is present, add it to cost_price
                            $product->selling_price = $product->cost_price + $product->profit_margin;
                        } elseif ($product->profit_percentage) {
                            // If profit_margin is not present, calculate using profit_percentage
                            $product->selling_price = $product->cost_price + ($product->cost_price * $product->profit_percentage / 100);
                        } else {
                            // If neither profit_margin nor profit_percentage is present, set to null
                            $product->selling_price = null;
                        }
                    } else {
                        // If cost_price is missing, set selling_price to null
                        $product->selling_price = null;
                    }

                    // Save the updated product with cost_price and selling_price
                    $product->save();
                }

                return $next($request);
            } else {
                return redirect(url('/admin-login'));
            }
        } else {
            return redirect(url('/admin-login'));
        }
    }
}
