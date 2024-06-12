<!DOCTYPE html>
<html>
<head>
    <title>Select Columns</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Выберите столбцы для экспорта</h2>
    <form action="{{ route('download.excel') }}" method="GET">
        <div class="form-group">
            @php
                $columns = [
                    'number' => '№',
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
                    'note' => 'Примечание'
                ];
            @endphp
            @foreach($columns as $key => $value)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="columns[]" value="{{ $key }}" id="{{ $key }}">
                    <label class="form-check-label" for="{{ $key }}">
                        {{ $value }}
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Download Excel</button>
    </form>
</div>
</body>
</html>
