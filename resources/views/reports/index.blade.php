@extends('layouts.admin')

@section('content')
    <div class="main_block">
        <h1>Отчеты</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('reports.index') }}" class="mb-4">
            <div class="form-group">
                <label for="date_filter">Фильтр по дате:</label>
                <select name="date_filter" id="date_filter" class="form-control" onchange="toggleCustomDateFields(this.value)">
                    <option value="today" {{ $dateFilter == 'today' ? 'selected' : '' }}>Сегодня</option>
                    <option value="yesterday" {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>Вчера</option>
                    <option value="this_month" {{ $dateFilter == 'this_month' ? 'selected' : '' }}>Этот месяц</option>
                    <option value="last_3_months" {{ $dateFilter == 'last_3_months' ? 'selected' : '' }}>Последние 3 месяца
                    </option>
                    <option value="custom" {{ $dateFilter == 'custom' ? 'selected' : '' }}>Выбрать период</option>
                </select>
            </div>

            <div id="custom-date-fields" style="display: {{ $dateFilter == 'custom' ? 'block' : 'none' }};">
                <div class="form-group">
                    <label for="start_date">Дата начала:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ isset($startDate) ? $startDate->format('Y-m-d') : '' }}">
                </div>
                <div class="form-group">
                    <label for="end_date">Дата окончания:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ isset($endDate) ? $endDate->format('Y-m-d') : '' }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Фильтровать</button>
            <a href="{{ route('reports.export', request()->all()) }}" class="btn btn-success">Экспортировать</a>
        </form>

        <!-- Data Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>№</th>
                    <th>ИНН</th>
                    <th>ПИНФЛ</th>
                    <th>Корхона номи</th>
                    <th>Шарт. №</th>
                    <th>Шартнома санаси</th>
                    <th>Якунлаш сана</th>
                    <th>Тўлов шарти</th>
                    <th>Тўлов муддати</th>
                    <th>Аванс</th>
                    <th>Туман</th>
                    <th>Шартнома қиймати</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $totalContractValue = 0;
                    $totalAdvancePayment = 0;
                    $totalMonthlyPayment = 0;
                    $totalTotalPayment = 0;
                    $totalRemaining = 0;
                @endphp
                @php
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
                @endphp
                @foreach ($branches as $index => $branch)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $branch->client->company->stir ?? '' }}</td>
                        @if (isset($branch->client->passport))
                        <td>{{ strval($branch->client->passport ? $branch->client->passport->passport_pinfl : '') }}</td>

                        @endif
                        <td>
                            {{ $branch->client && $branch->client->company ? $branch->client->company->company_name : ($branch->client ? $branch->client->first_name . ' ' . $branch->client->last_name : 'No Client') }}
                        </td>

                        <td>{{ $branch->contract_apt }}</td>
                        <td>{{ $branch->contract_date ? $branch->contract_date->format('d.m.Y') : '' }}</td>
                        <td>
                            @php
                                $quarterDays = ($branch->installment_quarterly / 4) * 365 + 1;
                                $newDate = \Carbon\Carbon::parse($branch->payment_deadline)->addDays($quarterDays);
                            @endphp
                            {{ $newDate->format('Y-m-d') }}

                        </td>
                        <td>
                            @if ($branch->payment_type == 'pay_full')
                                100
                            @else
                                {{ $branch->percentage_input }}/{{ 100 - $branch->percentage_input }}
                            @endif
                        </td>
                        <td>{{ $branch->installment_quarterly }}</td>
                        <td>{{ $branch->percentage_input }}%</td>
                        {{-- <td>{{ $branch->first_payment_percent }}</td> --}}
                        <td>{{ $regions[$branch->region] ?? '' }}</td>
                        <td>{{ number_format($branch->contract_value) }}</td>

                    </tr>
                    @php
                        $totalContractValue += $branch->contract_value;
                        $totalAdvancePayment += $branch->advance_payment;
                        $totalMonthlyPayment += $branch->monthly_payment;
                        $totalTotalPayment += $branch->total_payment;
                        $totalRemaining += $branch->remaining;
                    @endphp
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
        function toggleCustomDateFields(value) {
            var customFields = document.getElementById('custom-date-fields');
            if (value === 'custom') {
                customFields.style.display = 'block';
            } else {
                customFields.style.display = 'none';
            }
        }
    </script>
@endsection
