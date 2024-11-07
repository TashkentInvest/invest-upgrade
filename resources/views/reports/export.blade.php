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
                <td>{{ $branch->client->passport ? $branch->client->passport->passport_pinfl : '' }}</td>
                <td>{{ $branch->client->company->company_name ?? $branch->client->first_name . ' ' . $branch->client->last_name }}
                </td>
                <td>{{ $branch->contract_apt }}</td>
                <td>{{ $branch->contract_date ? $branch->contract_date->format('d.m.Y') : '' }}</td>
                <td>{{ $branch->payment_deadline ? $branch->payment_deadline->format('d.m.Y') : '' }}</td>
                <td>{{ $branch->payment_type }}</td>
                <td>{{ $branch->installment_quarterly }}</td>
                <td>{{ $branch->first_payment_percent }}%</td>
                <td>{{ $regions[$branch->region] ?? 'Mavjud emas' }}</td>
                <td>{{ number_format($branch->contract_value, 2, ',', ' ') }}</td>
     
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
