<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        // Retrieve the data collection based on the product ID
        $products = Products::with('client')->select('id', 'client_id','client:first_name', 'company_id', 'minimum_wage', 'contract_apt', 'contract_date', 'status')
                             ->where('id', $this->id)
                             ->get();

        // $products = Products::with('client:id,first_name')
        // ->select('id', 'client_id', 'company_id', 'minimum_wage', 'contract_apt', 'contract_date', 'status')
        // ->where('id', $this->id)
        // ->get();

        // Modify the collection to include client's name
        $products->transform(function ($product) {
            $product->client_name = $product->client->name;
            return $product;
        });

        return $products;
    }

    public function headings(): array
    {
        // Define the column headings
        return [
            'ID',
            'Client ID',
            'Company ID',
            'Minimum Wage',
            'Contract Apt',
            'Contract Date',
            'Status'
        ];
    }

//     $clientName = 'Client ABC'; // Replace this with the actual client's name
// return $this->downloadTableData($productId, $clientName);
}
