@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Yangi To'lov Qo'shish</h1>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="branch_id" value="{{ $branch_id }}">

        <div class="form-group">
            <label for="amount">Miqdor</label>
            <input type="text" name="amount" id="amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="payment_date">To'lov Sanasi</label>
            <input type="date" name="payment_date" id="payment_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="comment">Izoh</label>
            <input type="text" name="comment" id="comment" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary my-2">Saqlash</button>
    </form>
</div>
@endsection
