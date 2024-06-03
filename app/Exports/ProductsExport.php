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
        try {
            $query = DB::table('clients')
                ->join('branches', 'clients.id', '=', 'branches.client_id')
                ->select(
                    'clients.id AS number',
                    'clients.application_number AS application_number',
                    'clients.company_name AS company_name',
                    'clients.contact AS contact',
                    'clients.company_location AS district',
                    'branches.branch_kubmetr AS calculated_volume',
                    'branches.generate_price AS infrastructure_payment',
                    DB::raw("CAST(NULLIF(REPLACE(branches.generate_price, ',', ''), '') AS DECIMAL(10,2)) * CAST(branches.percentage_input AS DECIMAL(10,2)) / 100 AS calculated_amount"),
                    'branches.payed_sum AS paid_amount',
                    'branches.payed_date AS payment_date',
                    'branches.contract_apt AS contract_number',
                    'branches.contract_date AS contract_date',
                    'branches.notification_num AS notification_number',
                    'branches.notification_date AS notification_date',
                    'branches.insurance_policy AS insurance_policy',
                    'branches.bank_guarantee AS bank_guarantee',
                    'clients.client_description AS note'
                );
    
            if ($this->id !== null) {
                $query->where('clients.id', $this->id);
            }
    
            $query->orderBy('clients.updated_at', 'desc');
    
            return $query->get()->map(function ($item, $key) {
                $item->number = $key + 1; // Row number starts at 1
                return (array) $item;
            });
        } catch (\Exception $e) {
            // Handle the exception gracefully, you can log the error or return an empty collection
            \Log::error('Error exporting products: ' . $e->getMessage());
            return collect([]);
        }
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
            'Рассчитанная сумма',
            'Оплаченная сумма (сўм)',
            'Дата оплаты',
            '№ договора',
            'Дата договора',
            '№ уведомления',
            'Дата уведомления',
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
