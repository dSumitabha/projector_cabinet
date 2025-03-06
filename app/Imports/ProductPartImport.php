<?php

namespace App\Imports;

use App\Models\Part;
use App\Models\Product;
use App\Models\ProductPart;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductPartImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    private $totalCostPrice = 0;
    private $productId;
    private $validProductIds = [];

    public function __construct()
    {
        // Get all valid product IDs from the Product table
        $this->validProductIds = Product::pluck('product_id')->toArray();
    }

    public function model(array $row)
    {
        // Set the product ID for later use in the destructor
        $this->productId = $row['product_id'];

        // Fetch part details from the Part model using the part_id
        $part = Part::where('part_id', $row['part_id'])->first();

        if ($part) {
            // Initialize the base value for total calculation
            $totalHoursUnits = $row['total_hours_units'] ?? 1;
            $percentageUsed = $row['percentage_used'] ?? 100;

            $baseValue = 0;

            // Calculate baseValue based on rate or unit_cost from Part
            if ($part->rate && $part->rate !== 'N/A') {
                $baseValue = (float) $part->rate * $totalHoursUnits;
            } elseif ($part->unit_cost && $part->unit_cost !== 'N/A') {
                $baseValue = (float) $part->unit_cost * $totalHoursUnits;
            }

            // Calculate the total value considering percentage_used
            $total = $baseValue * ($percentageUsed / 100);

            // Accumulate totalCostPrice for this product
            $this->totalCostPrice += $total;

            // Return the new ProductPart instance with the calculated total
            return new ProductPart([
                'product_id' => $row['product_id'],
                'part_id' => $row['part_id'],
                'part_name' => $part->part_name,
                'part_type' => $part->part_type,
                'rate' => $part->rate,
                'unit_cost' => $part->unit_cost,
                'total_hours_units' => $totalHoursUnits,
                'percentage_used' => $percentageUsed,
                'total' => $total, // Store the calculated total
            ]);
        }

        return null; // Return null if part is not found (optional: handle this in validation)
    }

    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, $this->validProductIds)) {
                        $fail("The product_id '{$value}' does not exist in the Product table.");
                    }
                }
            ],
            'part_id' => 'required|exists:parts,part_id', // Ensure part_id exists in the Part model
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the validation failures
        foreach ($failures as $failure) {
            $row = $failure->row(); // Row that went wrong
            $attribute = $failure->attribute(); // Column that has the error
            $errors = $failure->errors(); // Actual error messages
            $values = $failure->values(); // The values of the row that has failed

            // Print the error details
            echo "Row {$row}: Validation failed for '{$attribute}' with error(s): " . implode(', ', $errors) . "\n";
        }
    }

    // After processing all rows, update the product's cost_price
    public function __destruct()
    {
        $product = Product::where('product_id', $this->productId)->first();

        if ($product) {
            // Add the accumulated totalCostPrice to the product's existing cost_price
            $product->cost_price = ($product->cost_price ?? 0) + $this->totalCostPrice;
            $product->save();
        }
    }
}
