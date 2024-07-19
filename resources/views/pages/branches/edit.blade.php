@extends('layouts.app')

@section('content')
<div class="container">
    <h1>To'lovni Yangilash</h1>

    {{-- @dd($payment) --}}
    <form action="{{ route('payment.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- <input type="hidden" name="branch_id" value="{{ $branch->id }}"> --}}

        <div class="form-group">
            <label for="amount">Miqdor</label>
            <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" required>
        </div>

        <div class="form-group">
            <label for="payment_date">To'lov Sanasi</label>
            <input type="date" name="payment_date" id="payment_date" class="form-control" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="comment">Izoh</label>
            <input type="text" name="comment" id="comment" class="form-control" value="{{ old('comment', $payment->comment) }}">
        </div>

        <button type="submit" class="btn btn-primary my-2">Yangilash</button>
    </form>
</div>
@endsection
