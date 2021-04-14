<?php

namespace App\Imports;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'manufacturer'  => $row['manufacturer'],
            'product_code' => $row['product_code'],
         	'title' => $row['title'],
         	'origin_country' => $row['origin_country'],
            'spare_location' =>$row['spare_location'],
            'weight'  => $row['weight'],
            'length' => $row['length'],
         	'width' => $row['width'],
            'height' =>$row['height'],
         	'condition' => $row['condition'],
            'packaging' =>$row['packaging'],
            'description' =>$row['description'],
        ]);
    }
    
   
}