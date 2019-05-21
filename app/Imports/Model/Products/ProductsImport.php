<?php

namespace App\Imports\Model\Products;

use App\Model\Products\Products;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Products::where('id','=',$row[0])
            ->update([
                'product_name' => $row[1],
                'price_1_1_a' => $row[2],
                'price_1_1_b' => $row[3],
                'price_1_1_c' => $row[4],
                'price_1_2_a' => $row[5],
                'price_1_2_b' => $row[6],
                'price_1_2_c' => $row[7],
                'price_2_1_a' => $row[8],
                'price_2_1_b' => $row[9],
                'price_2_1_c' => $row[10],
                'price_2_2_a' => $row[11],
                'price_2_2_b' => $row[12],
                'price_2_2_c' => $row[13],
                'price_3_1_a' => $row[14],
                'price_3_1_b' => $row[15],
                'price_3_1_c' => $row[16],
                'price_3_2_a' => $row[17],
                'price_3_2_b' => $row[18],
                'price_3_2_c' => $row[19]
            ]);
        return null;
    }
}
