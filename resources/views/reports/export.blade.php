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
            <th>Бўнак тўлов</th>
            <th>Ойлик тўлов</th>
            <th>Жами тўлов</th>
            <th>Қолдиқ</th>
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
        @foreach($branches as $index => $branch)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $branch->client->company->stir ?? '' }}</td>
                <td>{{ $branch->client->passport ? $branch->client->passport->passport_pinfl : '' }}</td>
                <td>{{ $branch->client->company->company_name ?? ($branch->client->first_name . ' ' . $branch->client->last_name) }}</td>
                <td>{{ $branch->contract_apt }}</td>
                <td>{{ $branch->contract_date ? $branch->contract_date->format('d/m/Y') : '' }}</td>
                <td>{{ $branch->payment_deadline ? $branch->payment_deadline->format('d/m/Y') : '' }}</td>
                <td>{{ $branch->payment_type }}</td>
                <td>{{ $branch->installment_quarterly }}</td>
                <td>{{ $branch->first_payment_percent }}%</td>
                <td>{{ $branch->region }}</td>
                <td>{{ number_format($branch->contract_value, 2, ',', ' ') }}</td>
                <td>{{ number_format($branch->advance_payment, 2, ',', ' ') }}</td>
                <td>{{ number_format($branch->monthly_payment, 2, ',', ' ') }}</td>
                <td>{{ number_format($branch->total_payment, 2, ',', ' ') }}</td>
                <td>{{ number_format($branch->remaining, 2, ',', ' ') }}</td>
            </tr>
            @php
                $totalContractValue += $branch->contract_value;
                $totalAdvancePayment += $branch->advance_payment;
                $totalMonthlyPayment += $branch->monthly_payment;
                $totalTotalPayment += $branch->total_payment;
                $totalRemaining += $branch->remaining;
            @endphp
        @endforeach
        <!-- Totals Row -->
        <tr>
            <td colspan="11">ЖАМИ</td>
            <td>{{ number_format($totalContractValue, 2, ',', ' ') }}</td>
            <td>{{ number_format($totalAdvancePayment, 2, ',', ' ') }}</td>
            <td>{{ number_format($totalMonthlyPayment, 2, ',', ' ') }}</td>
            <td>{{ number_format($totalTotalPayment, 2, ',', ' ') }}</td>
            <td>{{ number_format($totalRemaining, 2, ',', ' ') }}</td>
        </tr>
    </tbody>
</table>