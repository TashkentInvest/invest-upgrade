@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Transactions</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}" style="color: #007bff;">Transactions</a></li>
                    <li class="breadcrumb-item active">@lang('global.add')</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body border-bottom">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 card-title flex-grow-1">Transactions Lists</h5>
                    <div class="flex-shrink-0">
                        <a href="{{ route('import') }}" class="btn btn-primary">Import Exel</a>
                    </div>
                </div>
            </div>
            <div class="card-body border-bottom">
                <form action="{{ route('transactions.art') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
                
    
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle nowrap">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">№ Док</th>
                                <th scope="col">Дата платежа</th>
                                <th scope="col" style="width: 200px;">Назначение платежа</th>
                                <th scope="col">Дебит</th>
                                <th scope="col">Кредит</th>
                                <th scope="col">Инн</th>
                                <th scope="col">МФО</th>
                                <th scope="col">Расчетный счет</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->document_number }}</td>
                                    <td>{{ $transaction->payment_date }}</td>
                                    <td style="width: 200px;">{{ $transaction->payment_description }}</td>
                                    <td>{{ $transaction->debit }}</td>
                                    <td>{{ $transaction->credit }}</td>
                                    <td>{{ $transaction->payer_inn }}</td>
                                    <td>{{ $transaction->payer_mfo }}</td>
                                    <td>{{ $transaction->payer_account }}</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View">
                                                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex" style="justify-content: space-between">
                    {{-- {{$transactions->links()}} --}}
                
                    <h4 class="text-bold">Credit: {{$creditSum}}</h4>
                </div>
                <!--end row-->
            </div>
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }
    .table th {
        background-color: #f8f9fa;
    }
    .btn-soft-primary {
        background-color: #d1e7dd;
        border-color: #badbcc;
        color: #0f5132;
    }
    .btn-soft-primary:hover {
        background-color: #badbcc;
        border-color: #a5cfbb;
        color: #0f5132;
    }
    .card-body.border-bottom {
        border-bottom: 1px solid #e9ecef !important;
    }
</style>
@endpush