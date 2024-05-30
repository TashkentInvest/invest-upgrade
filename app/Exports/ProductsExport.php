<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromCollection, WithHeadings, WithColumnFormatting, ShouldAutoSize
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        // Fetch data from the database
        $data = DB::table('clients')
            ->join('companies', 'clients.id', '=', 'companies.client_id')
            ->join('branches', 'companies.id', '=', 'branches.company_id')
            ->select(
                'clients.id',
                'clients.first_name',
                'clients.last_name',
                'clients.father_name',
                'clients.mijoz_turi',
                'clients.contact',
                'companies.company_name',
                'companies.company_location',
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

        $formattedData = $data->map(function ($item, $key) {
            return [
                '№' => $key + 1,
                'Номер заявления' => '',
                'Наименование организации' => $item->mijoz_turi == 'yuridik' ? $item->company_name : $item->last_name . ' ' . $item->first_name . ' ' . $item->father_name,
                'Контакты' => $item->contact,
                'Район' => $item->company_location,
                'Расчетный объем здания' => $item->branch_kubmetr,
                'Инфраструктурный платеж (сўм) по договору' => $item->generate_price,
                'Первый платеж (сум) 20% от стоимости' => isset($item->generate_price, $item->percentage_input) && is_numeric($item->generate_price) && is_numeric($item->percentage_input) ? ($item->generate_price * $item->percentage_input) / 100 : '',

                'оплаченная сумма (сўм)' => '',
                'Дата оплаты' => '',
                '№ договора' => $item->contract_apt,
                'Дата договора' => $item->contract_date,
                '№ уведомления' => '',
                'Дата увед' => '', 
                'Страховой полис' => '', 
                'Банковская гарантия' => '', 
                'Примечание' => '' 
            ];
        });

        return collect($formattedData);
    }
    public function headings(): array
    {
        return [
            '№',
            'Номер заявления',
            'Наименование организации',
            'Контакты',
            'Район',
            'Расчетный объем здания',
            'Инфраструктурный платеж (сўм) по договору',
            'Первый платеж (сум) 20% от стоимости',
            'оплаченная сумма (сўм)',
            'Дата оплаты',
            '№ договора',
            'Дата договора',
            '№ уведомления',
            'Дата увед',
            'Страховой полис',
            'Банковская гарантия',
            'Примечание'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '@',
            'B' => '@',
            'C' => '@',
            'D' => '@',
            'E' => '@',
            'F' => '@',
            'G' => '@',
            'H' => '@',
            'I' => '@',
            'J' => '@',
            'K' => '@',
            'L' => '@',
            'M' => '@',
            'N' => '@',
            'O' => '@',
            'P' => '@',
            'Q' => '@'
        ];
    }
}
