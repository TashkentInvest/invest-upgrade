<!DOCTYPE html>
<html>
<head>
    <title>Select Columns</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
        }
        .container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h2 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 30px;
            color: #007bff;
        }
        .form-check-label {
            font-size: 16px;
        }
        .btn-secondary {
            font-size: 16px;
        }
        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-primary {
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-check-input {
            cursor: pointer;
        }
    </style>
    <script>
        function toggleCheckboxes(checked) {
            var checkboxes = document.querySelectorAll('input[name="columns[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = checked;
            });
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Выберите столбцы для экспорта</h2>
    <form action="{{ route('download.excel') }}" method="GET">
        <div class="form-group">
            @php
                $columns = [
                    //stir
                    //oked
                    //passport serya
                    //passport pinfl

                    //-----------------------------------
                    'stir' => 'Стир',
                    'oked' => 'Окэд',
                    'passport_serya' => 'Серия паспорта',
                    'passport_pinfl' => 'ПИНФЛ',
                    //-----------------------------------

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
            @endphp
            @foreach($columns as $key => $value)
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="columns[]" value="{{ $key }}" id="{{ $key }}">
                    <label class="form-check-label" for="{{ $key }}">
                        {{ $value }}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-secondary" onclick="toggleCheckboxes(true)">
                <i class="fas fa-check-circle"></i> Выбрать все
            </button>
            <button type="button" class="btn btn-secondary" onclick="toggleCheckboxes(false)">
                <i class="fas fa-times-circle"></i> Снять все
            </button>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">@lang('global.downloadFile')</button>
            <a href="{{ route('clientIndex') }}" class="btn btn-primary">@lang('global.home')</a>
        </div>
    </form>
</div>
</body>
</html>
