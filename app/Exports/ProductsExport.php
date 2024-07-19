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
    protected $selectedColumns;

    public function __construct($id = null, $startDate = null, $endDate = null, $selectedColumns = [])
    {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->selectedColumns = $selectedColumns;
    }

    public function collection()
    {
        try {
            $query = DB::table('clients')
                ->join('companies', 'clients.id', '=', 'companies.client_id')
                ->join('branches', 'clients.id', '=', 'branches.client_id')
                ->join('addresses', 'clients.id', '=', 'addresses.client_id')
                ->select($this->buildSelectColumns())
                ->distinct();

            $query->where('clients.is_deleted', '!=', 1);

            if ($this->id !== null) {
                $query->where('clients.id', $this->id);
            }

            if ($this->startDate !== null && $this->endDate !== null) {
                $query->whereBetween('clients.updated_at', [$this->startDate, $this->endDate]);
            }

            \Log::info('SQL Query: ' . $query->toSql());
            \Log::info('Bindings: ' . json_encode($query->getBindings()));

            $collection = $query->get();

            \Log::info('Fetched Collection: ' . json_encode($collection));

            $collection->each(function ($item) {
                $item->document_count = $this->getFileCount($item->client_id, 'documents/');
                $item->payment_count = $this->getFileCount($item->client_id, 'payment/');
                $item->ruxsatnoma_count = $this->getFileCount($item->client_id, 'ruxsatnoma/');
                $item->kengash_count = $this->getFileCount($item->client_id, 'kengash/');
                $item->loyiha_xujjati_count = $this->getFileCount($item->client_id, 'loyiha_xujjati/');
                $item->qurilish_xajmi_count = $this->getFileCount($item->client_id, 'qurilish_xajmi/');
                $item->apz_count = $this->getFileCount($item->client_id, 'apz/');
            });

            $collection = $collection->unique('client_id');

            return $collection->map(function ($item) {
                return (array) $item;
            });
        } catch (\Exception $e) {
            \Log::error('Error exporting products: ' . $e->getMessage());
            return collect([]);
        }
    }


    protected function buildSelectColumns()
    {
        $columns = [
            'clients.id' => 'clients.id AS client_id',
            'application_number' => 'branches.application_number AS application_number',
            'contract_number' => 'branches.contract_apt AS contract_number',
            'contract_date' => 'branches.contract_date AS contract_date',
            'notification_number' => 'branches.notification_num AS notification_number',
            'company_name' => 'companies.company_name AS company_name',
            'district' => 'addresses.yuridik_address AS district',
            'home_district' => 'addresses.home_address AS home_district',
            'calculated_volume' => 'branches.branch_kubmetr AS calculated_volume',
            'infrastructure_payment' => 'branches.generate_price AS infrastructure_payment',
            'percentage_input' => 'branches.percentage_input AS percentage_input',
            'paid_amount' => 'branches.payed_sum AS paid_amount',
            'payment_date' => 'branches.payed_date AS payment_date',
            'notification_date' => 'branches.notification_date AS notification_date',
            'branch_name' => 'branches.branch_name AS branch_name',
            'branch_type' => 'branches.branch_type AS branch_type',
            'branch_location' => 'branches.branch_location AS branch_location',
            'insurance_policy' => 'branches.insurance_policy AS insurance_policy',
            'bank_guarantee' => 'branches.bank_guarantee AS bank_guarantee',
            'contact' => 'clients.contact AS contact',
            'note' => 'clients.client_description AS note',
            // New columns for file counts
            'document_count' => DB::raw('0 AS document_count'),
            'payment_count' => DB::raw('0 AS payment_count'),
            'ruxsatnoma_count' => DB::raw('0 AS ruxsatnoma_count'),
            'kengash_count' => DB::raw('0 AS kengash_count'),
            'loyiha_xujjati_count' => DB::raw('0 AS loyiha_xujjati_count'),
            'qurilish_xajmi_count' => DB::raw('0 AS qurilish_xajmi_count'),
            'apz_count' => DB::raw('0 AS apz_count'),
        ];

        return array_intersect_key($columns, array_flip($this->selectedColumns)) + ['clients.id' => 'clients.id AS client_id'];
    }

    protected function getFileCount($clientId, $path)
    {
        return DB::table('files')
            ->where('client_id', $clientId)
            ->where('path', 'LIKE', '%' . $path . '%')
            ->count();
    }

    public function headings(): array
    {
        $headings = [
            'application_number' => 'Номер заявления',
            'contract_number' => '№ договора',
            'contract_date' => 'Дата договора',
            'notification_number' => '№ разрешения',
            'company_name' => 'Наименование организации',
            'district' => 'Юридический адрес',
            'home_district' => 'Домашний адрес',
            'calculated_volume' => 'Расчетный объем здания',
            'infrastructure_payment' => 'Инфраструктурный платеж (сўм) по договору',
            'percentage_input' => 'Процент предоплаты при рассрочке (%)',
            'paid_amount' => 'Оплаченная сумма (сўм)',
            'payment_date' => 'Дата оплаты',
            'notification_date' => 'Дата уведомления',
            'branch_name' => 'Название объекта',
            'branch_type' => 'Тип объекта',
            'branch_location' => 'Местоположение объекта',
            'insurance_policy' => 'Страховой полис',
            'bank_guarantee' => 'Банковская гарантия',
            'contact' => 'Контакты',
            'note' => 'Примечание',
            'document_count' => 'Количество документов',
            'payment_count' => 'Количество платежей',
            'ruxsatnoma_count' => 'Количество разрешений',
            'kengash_count' => 'Количество кенгашей',
            'loyiha_xujjati_count' => 'Количество проектов',
            'qurilish_xajmi_count' => 'Количество строительных объемов',
            'apz_count' => 'Количество APZ',
        ];

        return array_values(array_intersect_key($headings, array_flip($this->selectedColumns)));
    }


    public function columnFormats(): array
    {
        $alphabet = range('A', 'Z');
        $formats = [];

        foreach (array_keys($this->selectedColumns) as $index => $column) {
            $columnIndex = $this->getColumnLetter($index);
            $formats[$columnIndex] = '@';
        }

        return $formats;
    }

    protected function getColumnLetter($index)
    {
        $letters = '';
        while ($index >= 0) {
            $letters = chr(($index % 26) + 65) . $letters;
            $index = intval($index / 26) - 1;
        }
        return $letters;
    }

}
