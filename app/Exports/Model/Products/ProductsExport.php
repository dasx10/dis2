<?php

namespace App\Exports\Model\Products;

use App\Model\Products\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection,WithHeadings
{

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'Product Name',
            'Product Code',
            'Specification',
            'CAS',
            'Category',
            'Brand',
            'Shipping Class',
            'Type of the Packaging 1',
            'Type of the Packaging 2',
            'Type of the Packaging 3',
            'Pallet/Without pallet',
            'Pallet capacity of packaging 1',
            'Pallet capacity of packaging 2',
            'Pallet capacity of packaging 3',
            'MOQ 1 for the packaging 1',
            'MOQ 1 for the packaging 2',
            'MOQ 1 for the packaging 3',
            'MOQ 2 for the packaging 1',
            'MOQ 2 for the packaging 2',
            'MOQ 2 for the packaging 3',
            'MOQ 3 for the packaging 1',
            'MOQ 3 for the packaging 2',
            'MOQ 3 for the packaging 3',
            'Price of Product - Pack 1 MOQ1',
            'Price of Product - Pack 1 MOQ2',
            'Price of Product - Pack 1 MOQ3',
            'L * W * H of the packaging 1 (m)',
            'L * W * H of the packaging 1 on pallet (m)',
            'L * W * H of the packaging 2 (m)',
            'L * W * H of the packaging 2 on pallet (m)',
            'L * W * H of the packaging 3 (m)',
            'L * W * H of the packaging 3 on pallet (m)',
            'Loading Port 1',
            'Restrictions',
            'Descriptions',
            'Information of FCL quantity (with/without pallet)'
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Products::select(
            'id',
            'product_name',
            'product_code',
            'specification',
            'cas','category',
            'brand',
            'shipping_class',
            'type_of_packaging1',
            'type_of_packaging2',
            'type_of_packaging3',
            'pallet_without_pallet',
            'pallet_capacity_for_packaging_type_1',
            'pallet_capacity_for_packaging_type_2',
            'pallet_capacity_for_packaging_type_3',
            'moc_1_1',
            'moc_1_2',
            'moc_1_3',
            'moc_2_1',
            'moc_2_2',
            'moc_2_3',
            'moc_3_1',
            'moc_3_2',
            'moc_3_3',
            'price_prod_plus_packaging1',
            'price_prod_plus_packaging2',
            'price_prod_plus_packaging3',
            'lwh_packaging1_wp',
            'lwh_packaging1_p',
            'lwh_packaging2_wp',
            'lwh_packaging2_p',
            'lwh_packaging3_wp',
            'lwh_packaging3_p',
            'loading_port',
            'restrictions',
            'descr',
            'fcl'

        )->get();
    }
}
