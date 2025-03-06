<?php

namespace App\Imports;

use App\Models\Layout;

use App\Models\FusionFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LayoutImport implements ToCollection, WithHeadingRow
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
                'layout_id' => 'required',
                'grain_no_grain' => 'required',
                'layout_name' => 'nullable',
                'file_attachment' => 'nullable',

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
                Layout::create([
                    'layout_id' => $row['layout_id'],
                    'grain_no_grain' => $row['grain_no_grain'],
                    'layout_name' => $row['layout_name'],
                    'file_attachment' => $row['file_attachment'],
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
                return sprintf("Error for Layout Id '%s': %s", $error['row']['layout_id'], $errorMessage);
            })->all();
        })->flatten()->all();
    }
}
