<?php

namespace App\Imports;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $row['part'] = str_replace("-","",$row['part']);
        return new Product([
            'part' => $row['part'],
            'description' => $row['description'],
            'price' => $row['price'],
            'qty' => $row['qty'],
            'origin' =>$row['origin'],
            'weight'  => $row['weight'],
            'vweight'  => $row['vweight'],
            'length' => $row['length'],
            'width' => $row['width'],
            'height' =>$row['height'],
        ]);
    }
    
   
}