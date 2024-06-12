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
    protected $startDate;
    protected $endDate;

    public function __construct($id = null, $startDate = null, $endDate = null)
    {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        try {
            $query = DB::table('clients')
                ->join('branches', 'clients.id', '=', 'branches.client_id')
                ->select(
                    'clients.id AS number',
                    'branches.application_number AS application_number',
                    'branches.contract_apt AS contract_number',
                    'branches.contract_date AS contract_date',
                    'branches.notification_num AS notification_number',

                    'clients.company_name AS company_name',
                    'clients.yuridik_address AS district',
                    'clients.home_address AS home_district',
                    'branches.branch_kubmetr AS calculated_volume',
                    'branches.generate_price AS infrastructure_payment',
                    'branches.percentage_input AS percentage_input',
                    // DB::raw("CAST(NULLIF(REPLACE(branches.generate_price, ',', ''), '') AS DECIMAL(10,2)) * CAST(branches.percentage_input AS DECIMAL(10,2)) / 100 AS calculated_amount"),
                    'branches.payed_sum AS paid_amount',
                    'branches.payed_date AS payment_date',
                    
                    'branches.notification_date AS notification_date',
                    'branches.branch_name AS branch_name',
                    'branches.branch_type AS branch_type',
                    'branches.branch_location AS branch_location',
                    'branches.insurance_policy AS insurance_policy',
                    'branches.bank_guarantee AS bank_guarantee',
                    'clients.contact AS contact',
                    'clients.client_description AS note'
                );

                $query->where('clients.is_deleted', '!=', 1);

            if ($this->id !== null) {
                $query->where('clients.id', $this->id);
            }
            // Apply date filters if provided
            if ($this->startDate !== null && $this->endDate !== null) {
                $query->whereBetween('clients.updated_at', [$this->startDate, $this->endDate]);
            }

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
            '№ договора',
            'Дата договора',
            '№ разрешения',
            'Наименование организации',
            'Юридический адрес',
            'Домашний адрес',
            'Расчетный объем здания',
            'Инфраструктурный платеж (сўм) по договору',
            'Процент предоплаты при рассрочке (%)',
            // 'Рассчитанная сумма',    
            'Оплаченная сумма (сўм)',
            'Дата оплаты',
            'Дата уведомления',
            'Название объекта',
            'Тип объекта',
            'Местоположение объекта',
            'Страховой полис',
            'Банковская гарантия',
            'Контакты',
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
