<?php
namespace App\Exports;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BranchesExport implements FromCollection, WithHeadings, WithColumnFormatting, WithStyles
{
    // The collection of data to export
    public function collection()
    {
        return Branch::with('client', 'client.passport', 'client.company')->get()->map(function ($branch, $index) {
            $pinfl = $branch->client->passport->passport_pinfl ?? '';  // Retrieve PINFL
    
            // Ensure PINFL is treated as a string, and avoid scientific notation
            $pinfl = (string)$pinfl;
    
            // Optionally, if PINFL is empty or null, we can assign a default value or leave it as empty
            if (empty($pinfl)) {
                $pinfl = '';  // If PINFL is empty, we can leave it blank or set a placeholder
            }
    
            return [
                'index' => $index + 1,  // Row number (№)
                'stir' => $branch->client->company->stir ?? '',  // INN (TIN)
                'pinfl' => $pinfl ? $pinfl .' ' : '',  // Ensure PINFL is a string
                'company_name' => $branch->client && $branch->client->company ? $branch->client->company->company_name : 
                                  ($branch->client ? $branch->client->first_name . ' ' . $branch->client->last_name : 'No Client'),  // Company name or client name
                'contract_apt' => $branch->contract_apt,  // Contract number
                'contract_date' => $branch->contract_date ? $branch->contract_date->format('d.m.Y') : '',  // Contract date
                'completion_date' => \Carbon\Carbon::parse($branch->payment_deadline)->addDays(($branch->installment_quarterly / 4) * 365 + 1)->format('Y-m-d'),  // Completion date
                'payment_type' => $branch->payment_type == 'pay_full' ? 100 : $branch->percentage_input . '/' . (100 - $branch->percentage_input),  // Payment type
                'installment_quarterly' => $branch->installment_quarterly,  // Installment quarterly
                'percentage_input' => $branch->percentage_input . '%',  // Percentage input
                'region' => $this->getRegionName($branch->region),  // Region name
                'contract_value' => number_format($branch->contract_value),  // Contract value
            ];
        });
    }
    

    // Define table headers
    public function headings(): array
    {
        return [
            '№',
            'ИНН',
            'ПИНФЛ',
            'Корхона номи',
            'Шарт. №',
            'Шартнома санаси',
            'Якунлаш сана',
            'Тўлов шарти',
            'Тўлов муддати',
            'Аванс',
            'Туман',
            'Шартнома қиймати'
        ];
    }

    // Format the ПИНФЛ (column 'C') as text
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,  // Ensures PINFL is treated as text
        ];
    }

    // Apply text format to the entire column 'C' (ПИНФЛ)
    public function styles($sheet)
    {
        $sheet->getStyle('C')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT); // Force column C to be text format
    }

    // Get region name based on region code
    private function getRegionName($regionCode)
    {
        $regions = [
            '01' => 'Учтепа',
            '02' => 'Бектемир',
            '03' => 'Чилонзор',
            '04' => 'Яшнобод',
            '05' => 'Яккасарой',
            '06' => 'Сергели',
            '07' => 'Юнусабод',
            '08' => 'Олмазор',
            '09' => 'Мирзо Улуғбек',
            '10' => 'Шайхонтохур',
            '11' => 'Миробод',
            '12' => 'Янгихаёт',
        ];

        return $regions[$regionCode] ?? 'Mavjud emas';  // Default to 'Mavjud emas' if region not found
    }
}
