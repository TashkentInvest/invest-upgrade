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

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $query = DB::table('clients')
            ->join('companies', 'clients.id', '=', 'companies.client_id')
            ->join('branches', 'companies.id', '=', 'branches.company_id')
            ->select(
                'clients.id',
                'clients.first_name',
                'companies.company_name',
                'clients.contact',
                'companies.company_location',
                'branches.branch_kubmetr',
                'branches.generate_price',
                'branches.payed_date',
                'branches.payed_sum',
                'branches.contract_date',
                'branches.notification_num',
                'branches.notification_date',
                'branches.insurance_policy',
                'branches.bank_guarantee',
                'clients.client_description'
            );

            

        if ($this->id !== null) {
            $query->where('clients.id', $this->id);
        }

        return $query->get();
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