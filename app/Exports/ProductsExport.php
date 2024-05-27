<?php

namespace App\Exports;

use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Facades\Excel;

class ProductsExport implements FromCollection, WithHeadings, WithColumnFormatting, ShouldAutoSize
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        // Manual join to fetch data from clients and companies tables
        $data = DB::table('clients')
            ->join('companies', 'clients.id', '=', 'companies.client_id')
            ->select(
                'clients.id',
                'clients.first_name',
                'clients.last_name',
                'clients.father_name',
                'clients.first_name as client_name',
                'companies.company_name',
                'companies.company_location',
                'companies.raxbar'
            )
            ->where('clients.id', $this->id)
            ->get();

        return $data;
    }

    public function headings(): array
    {
        // Define the column headings
        return [
            'ID',
            'First Name',
            'Last Name',
            'Father Name',
            'Client Name',
            'Company Name',
            'Company Location',
            'Company Raxbar'
        ];
    }

    public function columnFormats(): array
    {
        // Define column widths
        return [
            'A' => 10,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20
        ];
    }
    public static function downloadTableData($id)
    {
        // Retrieve client details
        $client = Client::find($id);

        // Generate file name with current date, client's first name, and last name
        $fileName = 'products_data_' . $client->first_name . '_' . $client->last_name . '_' . now()->format('Y-m-d') . '.xls';

        // Download Excel file with dynamically generated file name
        return Excel::download(new ProductsExport($id), $fileName);
    }


    // public static function downloadTableData($id)
    // {
    //     return Excel::download(new ProductsExport($id), 'products_data.xls');
    // }
}
