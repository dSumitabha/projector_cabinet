<?php

namespace App\Imports;

use App\Models\FusionFile;

use App\Models\AssemblyPart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssembleImport implements ToCollection, WithHeadingRow
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
                'assembly_part_id' => 'required',
                'part_id' => 'required',
                'product_id' => 'nullable',
                'packaging_product_id' => 'required',
                'package_s_no' => 'nullable',
                'layer' => 'nullable',

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
                AssemblyPart::create([
                    'assembly_part_id' => $row['assembly_part_id'],
                    'part_id' => $row['part_id'],
                    // 'product_id' => $row['product_id'],
                    'packaging_product_id' => $row['packaging_product_id'],
                    'package_s_no' => $row['package_s_no'],
                    'qty' => $row['layer'],
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
                return sprintf("Error for Product Assemble Part Id '%s': %s", $error['row']['assembly_part_id'], $errorMessage);
            })->all();
        })->flatten()->all();
    }
}
