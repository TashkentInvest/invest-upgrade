<table>
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

                <td>{{ sprintf('%.5E', $branch->client->passport ? $branch->client->passport->passport_pinfl : '') }}</td>
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
                <td>{{ $regions[$branch->region] ?? 'Mavjud emas' }}</td>
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
