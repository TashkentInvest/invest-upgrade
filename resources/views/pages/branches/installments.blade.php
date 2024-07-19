@extends('layouts.app')

@section('content')
<div class="container">
    <h1>To'lov Choraklari</h1>
    <h2>{{ $branch->branch_name }}</h2>
    <a href="{{ route('payments.create', ['branch_id' => $branch->id]) }}" class="btn btn-primary mb-3">Yangi To'lov Qo'shish</a>
    @if($installments)
    @foreach($installments as $year => $quarters)
    <h3>Yil: {{ $year }}</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Chorak</th>
                <th>To'lov Miqdori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quarters as $quarter => $amount)
            <tr>
                <td>{{ $quarter }}</td>
                <td>{{ number_format($amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
    @else
    <p>Not found</p>
    @endif
</div>
@endsection
