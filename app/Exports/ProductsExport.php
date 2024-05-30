<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromCollection, WithHeadings, WithColumnFormatting, ShouldAutoSize
{
    public function collection()
    {
        // Manual join to fetch data from your tables
        $data = collect([
            [
                '№' => 1,
                'Номер заявления' => '117688604',
                'Наименование организации' => '"BUILDING CONNECTION" МЧЖ',
                'Контакты' => 'Шохруз +998901979696',
                'Район' => 'Алмазарский',
                'Расчетный объем здания' => '33 818,40',
                'Инфраструктурный платеж (сўм) по договору' => '11 498 256 000',
                'Первый платеж (сум) 20% от стоимости' => '2 299 651 200',
                'оплаченная сумма (сўм)' => '2,299,651,200.00',
                'Дата оплаты' => '5/16/2024',
                '№ договора' => 'АРТ-1/24',
                'Дата договора' => '4/8/2024',
                '№ уведомления' => '',
                'Дата увед' => '',
                'Страховой полис' => '',
                'Банковская гарантия' => '',
                'Примечание' => 'получил договор, оплатил 20% в полном объеме 16.05.2024'
            ],
            // Add the rest of your data here...
        ]);

        return $data;
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
