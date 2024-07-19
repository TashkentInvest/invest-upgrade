<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To'lov Choraklari</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            color: #333;
            margin: 0;
            padding-bottom: 10px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .alert-custom {
            background-color: #e0e0e0;
            color: #333;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
        .card {
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        .card h3 {
            margin-top: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #f8f9fa;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Title -->
    <h1>To'lov Choraklari</h1>
    <h2>{{ $branch->branch_name }}</h2>
    <a href="{{ route('payments.create', ['branch_id' => $branch->id]) }}" class="btn-custom">Yangi To'lov Qo'shish</a>

    <!-- Total Sum Alert -->
    @if($installments)
        @php
            $totalSum = 0;
            foreach ($installments as $quarters) {
                foreach ($quarters as $data) {
                    $totalSum += $data['total'];
                }
            }
        @endphp

        <div class="alert-custom">
            <h3>Jami To'langan Miqdor: {{ number_format($totalSum, 2) }} UZS</h3>
            <h3>Qolgan to'lashi kereak: {{ number_format(($branch->generate_price - $branch->first_payment_percent) - $totalSum, 2) }} UZS</h3>
        </div>

        <!-- Installments Table Card -->
        @foreach($installments as $year => $quarters)
            <div class="card">
                <h3>Yil: {{ $year }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Chorak</th>
                            <th>To'lov Miqdori</th>
                            <th>Izoh</th>
                            {{-- <th>Details</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quarters as $quarter => $data)
                            <tr>
                                <td>{{ $quarter }}</td>
                                <td>{{ number_format($data['total'], 2) }} UZS</td>
                                <td>
                                    @if(!empty($data['comments']))
                                        <ul style="list-style: none; padding: 0; margin: 0;">
                                            @foreach($data['comments'] as $comment)
                                                <li>{{ $comment }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No comments</p>
                                    @endif
                                </td>
                             
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

    @else
        <div class="alert-custom">
            <p class="mb-0">Afsuski topilmadi</p>
        </div>
    @endif

    <!-- General Object Information Card -->
    <div class="card">
        <h3>Umumiy Obyekt xaqida malumotlar</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>To'lov Foizi</th>
                    <th>To'lov Choraki</th>
                    <th>To'lov Summasi</th>
                    <th>Birinchi to'lov</th>
                    <th>Chorak bo'yicha to'landigan summa</th>
                    <th>To'lagan sana</th>
                    <th>To'lovni tugatishi kerak bo'lgan sana</th>
                    <th>Barcha Ma'lumotlar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $branch->percentage_input }}%</td>
                    <td>{{ $branch->installment_quarterly }}</td>
                    <td>{{ number_format($branch->generate_price, 2) }} UZS</td>
                    <td>{{ number_format($branch->first_payment_percent, 2) }} UZS</td>
                    <td>{{ number_format($branch->generate_price - $branch->first_payment_percent, 2) }} UZS</td>
                    <td>{{ $branch->payed_date ? $branch->payed_date->format('d-m-Y') : 'N/A' }}</td>
                    <td>{{ $branch->payment_deadline ? $branch->payment_deadline->format('d-m-Y') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('payment.show', $branch->id) }}" class="btn-custom">
                            Batafsil
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Include Bootstrap JS (optional) -->
</body>
</html>
