<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .box {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container box">
        <h1>Obyekt Ma'lumotlari</h1>

        <h3>Ariza raqami: <span>{{ $branch->application_number }}</span></h3>
        <h3>Shartnoma raqami: <span>{{ $branch->contract_apt }}</span></h3>
        <h3>Shartnoma sanasi: <span>{{ $branch->contract_date }}</span></h3>
        <h3>Obyekt nomi: <span>{{ $branch->branch_name ?? '--' }}</span></h3>
        <h3>Obyekt Joylashuvi: <span>{{ $branch->branch_location ?? '--' }}</span></h3>
        <h3>Obyekt Xajmi: <span>{{ $branch->branch_kubmetr ?? '--' }} m³</span></h3>
    </div>

    <div class="container">
        <h1>To'lov Ma'lumotlari</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>To'lov Miqdori</th>
                    <th>Izohlar</th>
                    <th>To'lagan Sana</th>
                    <th>Yaratilgan Sana</th>
                    <th>O'zgartirish yoki O'chirish</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($branch->payments as $p)
                <tr>
                    <td>{{ number_format($p->amount, 2) }} UZS</td>
                    <td>{{ $p->comment ?? 'No comments' }}</td>
                    <td>{{ $p->payment_date ? $p->payment_date->format('d-m-Y') : 'N/A' }}</td>
                    <td>{{ $p->created_at ? $p->created_at->format('d-m-Y') : 'N/A' }}</td>
                    <td>
                        <form action="{{ route('paymentDestroy', $p->id) }}" method="POST">
                            @csrf
                            @method('DELETE') <!-- This is required to simulate a DELETE request -->
                            <ul class="list-unstyled hstack gap-1 mb-0 d-flex" style="display: flex; gap: inherit;">
                                <button onclick="if (confirm('Вы уверены?')) { this.form.submit() }" 
                                    type="button" data-bs-toggle="modal" class="btn btn-danger" 
                                    style="margin-right:10px; cursor: pointer;">
                                    Delete
                                </button>
                               
                               <a class="btn btn-danger" href="{{route('payments.edit', $p->id)}}" style="margin-right:10px; cursor: pointer;">Edit</a>
                            </ul>
                        </form>
                    </td>
                </tr>
            @endforeach
            
            </tbody>
        </table>
        <a class="btn" href="{{ route('branches.installments', $branch->id) }}">Ortga</a>
    </div>

    <!-- Edit Payment Modal -->

</body>

</html>
