<?php

namespace App\Imports;

use App\Models\PackageProduct;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PackageProductImport implements ToCollection, WithHeadingRow
{
    private $errors = [];
    private $validRows = [];
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Convert keys to lowercase for consistency
            $row = array_change_key_case($row->toArray(), CASE_LOWER);

            // Define validation rules
            $validator = Validator::make($row, [
                'packaging_product_id' => 'required',
                'package_s_no' => 'required',
                'length_of_package' => 'nullable',
                'width_of_package' => 'nullable',
                'depth_of_package' => 'nullable',
                'weight_of_package' => 'required',
            ]);

            if ($validator->fails()) {
                $this->errors[] = [
                    'row' => $row,
                    'errors' => $validator->errors()->all()
                ];
            } else {
                // Add valid row to the validRows array
                $this->validRows[] = $row;
            }
        }

        // If there are no errors, proceed with inserting the valid rows
        if (empty($this->errors)) {
            foreach ($this->validRows as $row) {
                PackageProduct::create([
                    'packaging_product_id' => $row['packaging_product_id'],
                    'package_s_no' => $row['package_s_no'],
                    'length_of_package' => $row['length_of_package'],
                    'width_of_package' => $row['width_of_package'],
                    'depth_of_package' => $row['depth_of_package'],
                    'weight_of_package' => $row['weight_of_package'],

                ]);
            }
        }
    }

    public function getErrors()
    {
        return collect($this->errors)->map(function ($error) {

            // Map and format other validation errors with part_id if applicable
            return collect($error['errors'])->map(function ($errorMessage) use ($error) {
                // Attach part_id to other validation error messages
                return sprintf("Error for Packaging product Id '%s': %s", $error['row']['packaging_product_id'], $errorMessage);
            })->all();
        })->flatten()->all();
    }
}
