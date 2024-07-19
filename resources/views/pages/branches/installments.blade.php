@extends('layouts.app')

@section('content')
<div class="container">
    <h1>To'lov Choraklari</h1>
    <h2>{{ $branch->branch_name }}</h2>
    <a href="{{ route('payments.create', ['branch_id' => $branch->id]) }}" class="btn btn-primary mb-3">Yangi To'lov Qo'shish</a>

    @if($installments)
        @php
            $totalSum = 0;
            foreach ($installments as $quarters) {
                foreach ($quarters as $data) {
                    $totalSum += $data['total'];
                }
            }
        @endphp

        <h3>Jami To'lov Miqdori: {{ number_format($totalSum, 2) }}</h3>

        @foreach($installments as $year => $quarters)
            <h3>Yil: {{ $year }}</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Chorak</th>
                        <th>To'lov Miqdori</th>
                        <th>Izoh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quarters as $quarter => $data)
                        <tr>
                            <td>{{ $quarter }}</td>
                            <td>{{ number_format($data['total'], 2) }}</td>
                            <td>
                                @if(!empty($data['comments']))
                                    <ul>
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
        @endforeach

        @else
        
        <p>Not found</p>
        @endif

        <h3 class="text-center">Umumiy Obyekt xaqida malumotlar</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>To'lov</th>
                    <th>Birinchi to'lov</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{ $quarter }}</td>
                        <td>{{ number_format($branch->first_payment_percent, 2) }}</td>
                    </tr>
            </tbody>
        </table>

</div>
@endsection
