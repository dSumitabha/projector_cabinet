<?php
namespace App\Imports;
use App\Models\Part;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PartsImport implements ToCollection, WithHeadingRow
{
    private $errors = [];
    private $validRows = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Convert keys to lowercase for consistency
            $row = array_change_key_case($row->toArray(), CASE_LOWER);

            // Define validation rules
            $validator = Validator::make($row, [
                'part_id' => 'required|unique:parts,part_id',
                'part_category' => 'required',
                'part_or_service_name' => 'required',
                'part_type' => 'required',
                'rate' => 'required_if:part_type,Service|nullable|numeric',
                'unit_cost' => 'required_if:part_type,Physical|nullable|numeric',
            ], [
                'unit_cost.required_if' => sprintf("The unit cost field is required when part type is Physical for part ID '%s'.", $row['part_id'])
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
                Part::create([
                    'part_id' => $row['part_id'],
                    'part_category' => $row['part_category'],
                    'part_or_service_name' => $row['part_or_service_name'],
                    'source_company' => $row['source_company'],
                    'delivery_time' => $row['delivery_time'],
                    'part_type' => $row['part_type'],
                    'rate' => $row['rate'],
                    'batch_cost' => $row['batch_cost'],
                    'sales_tax' => $row['sales_tax'],
                    'qty' => $row['qty'],
                    'unit_cost' => $row['unit_cost'],
                    'available_qty' => $row['available_qty'],
                    'url' => $row['url'],
                    'part_dimensions_length' => $row['part_dimensions_length'],
                    'part_dimensions_width' => $row['part_dimensions_width'],
                    'part_dimensions_depth' => $row['part_dimensions_depth'],
                    'part_dimension_weight' => $row['part_dimension_weight'],
                    'edge_banding_lf' => $row['edge_banding_lf'],
                ]);
            }
        }
    }

    public function getErrors()
    {
        return collect($this->errors)->map(function ($error) {
            // Check if the error is a duplicate error
            if (isset($error['errors'][0]) && str_contains($error['errors'][0], 'has already been taken')) {
                return sprintf("The part id '%s' has already been taken.", $error['row']['part_id']);
            }

            // Map and format other validation errors with part_id if applicable
            return collect($error['errors'])->map(function ($errorMessage) use ($error) {
                // Attach part_id to other validation error messages
                return sprintf("Error for part id '%s': %s", $error['row']['part_id'], $errorMessage);
            })->all();
        })->flatten()->all();
    }
}
