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
        // Manual join to fetch data from clients, companies, and branches tables
        $data = DB::table('clients')
            ->join('companies', 'clients.id', '=', 'companies.client_id')
            ->join('branches', 'companies.id', '=', 'branches.company_id')
            ->select(
                'clients.id',
                'clients.first_name',
                'clients.last_name',
                'clients.father_name',
                'clients.first_name as client_name',
                'companies.company_name',
                'companies.company_location',
                'companies.raxbar',
                'branches.contract_apt',
                'branches.contract_date',
                'branches.branch_kubmetr',
                'branches.generate_price',
                'branches.payment_type',
                'branches.percentage_input',
                'branches.installment_quarterly'
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
            'Company Raxbar',
            'Contract Apt',
            'Contract Date',
            'Branch Kubmetr',
            'Generate Price',
            'Payment Type',
            'Percentage Input',
            'Installment Quarterly'
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
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
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
}
