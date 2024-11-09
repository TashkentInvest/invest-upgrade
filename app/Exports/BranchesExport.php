<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BranchesExport implements FromCollection, WithHeadings, WithColumnFormatting, WithStyles
{
    protected $branches;

    public function __construct($branches)
    {
        $this->branches = $branches;
    }

    public function collection()
    {
        return $this->branches->map(function ($branch, $index) {
            $pinfl = (string)($branch->client->passport->passport_pinfl ?? '');

            return [
                'index' => $index + 1,
                'stir' => $branch->client->company->stir ?? '',
                'pinfl' => $pinfl ? $pinfl .' ' : '',
                'company_name' => $branch->client->company->company_name ?? 
                                  ($branch->client ? $branch->client->first_name . ' ' . $branch->client->last_name : 'No Client'),
                'contract_apt' => $branch->contract_apt,
                'contract_date' => $branch->contract_date ? $branch->contract_date->format('d.m.Y') : '',
                'completion_date' => \Carbon\Carbon::parse($branch->payment_deadline)->addDays(($branch->installment_quarterly / 4) * 365 + 1)->format('Y-m-d'),
                'payment_type' => $branch->payment_type == 'pay_full' ? 100 : $branch->percentage_input . '/' . (100 - $branch->percentage_input),
                'installment_quarterly' => $branch->installment_quarterly,
                'percentage_input' => $branch->percentage_input . '%',
                'region' => $this->getRegionName($branch->region),
                'contract_value' => number_format($branch->contract_value),
            ];
        });
    }

    public function headings(): array
    {
        return [
            '№', 'ИНН', 'ПИНФЛ', 'Корхона номи', 'Шарт. №', 'Шартнома санаси',
            'Якунлаш сана', 'Тўлов шарти', 'Тўлов муддати', 'Аванс', 'Туман', 'Шартнома қиймати'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles($sheet)
    {
        $sheet->getStyle('C')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
    }

    private function getRegionName($regionCode)
    {
        $regions = [
            '01' => 'Учтепа', '02' => 'Бектемир', '03' => 'Чилонзор', '04' => 'Яшнобод',
            '05' => 'Яккасарой', '06' => 'Сергели', '07' => 'Юнусабод', '08' => 'Олмазор',
            '09' => 'Мирзо Улуғбек', '10' => 'Шайхонтохур', '11' => 'Миробод', '12' => 'Янгихаёт',
        ];
        return $regions[$regionCode] ?? 'Mavjud emas';
    }
}
