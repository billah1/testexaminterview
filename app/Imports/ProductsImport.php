<?php
// app/Imports/DoctorImport.php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows = $rows->slice(1);
        foreach ($rows as $row) {
            // Skip rows where all values are null
            if (count(array_filter($row->toArray())) === 0) {
                continue;
            }

            // Create a new Doctor instance and fill it with data
            $product = new Product([
                'category_id' => $row[0],
                'name' => $row[1],
                'price' => $row[2],
                'quantity' => $row[3],
                'status' => $row[4],
            ]);

            // Save the Doctor instance to the database
            $product->save();
        }
    }
}
