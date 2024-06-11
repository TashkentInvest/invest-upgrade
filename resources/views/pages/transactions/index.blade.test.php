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
                <div class="row g-3">
                    <div class="col-xxl-4 col-lg-6">
                        <input type="search" class="form-control" id="searchInput" placeholder="Search for ...">
                    </div>
                    <div class="col-xxl-2 col-lg-6">
                        <select class="form-control select2">
                            <option>Status</option>
                            <option value="Active">Active</option>
                            <option value="New">New</option>
                            <option value="Close">Close</option>
                        </select>
                    </div>
                    <div class="col-xxl-2 col-lg-4">
                        <select class="form-control select2">
                            <option>Select Type</option>
                            <option value="1">Full Time</option>
                            <option value="2">Part Time</option>
                        </select>
                    </div>
                    <div class="col-xxl-2 col-lg-4">
                        <div id="datepicker1">
                            <input type="text" class="form-control" placeholder="Select date" data-date-format="dd M, yyyy" data-date-autoclose="true" data-date-container='#datepicker1' data-provide="datepicker">
                        </div>
                    </div>
                    <div class="col-xxl-2 col-lg-4">
                        <button type="button" class="btn btn-soft-secondary w-100"><i class="mdi mdi-filter-outline align-middle"></i> Filter</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle nowrap">
                        <thead>
                            <th scope="col">No</th>
                                    <th scope="col">№ Док</th>
                                    {{-- <th scope="col">Operation Code</th>
                                    <th scope="col">Recipient Name</th>
                                    <th scope="col">Recipient INN</th>
                                    <th scope="col">Recipient MFO</th>
                                    <th scope="col">Recipient Account</th> --}}
                                    <th scope="col">Дата платежа</th>
                                    <th scope="col">Назначение платежа</th>
                                    <th scope="col">Дебит</th>
                                    <th scope="col">Кредит</th>
                                    {{-- <th scope="col">Payer Name</th> --}}
                                    <th scope="col">Инн</th>
                                    <th scope="col">МФО</th>
                                    {{-- <th scope="col">Payer Bank</th> --}}
                                    <th scope="col">Расчетный счет</th>
                                   
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            {{-- @dd($transaction->document_number) --}}
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->document_number }}</td>
                                    {{-- <td>{{ $transaction->operation_code }}</td>
                                    <td>{{ $transaction->recipient_name }}</td>
                                    <td>{{ $transaction->recipient_inn }}</td>
                                    <td>{{ $transaction->recipient_mfo }}</td>
                                    <td>{{ $transaction->recipient_account }}</td> --}}
                                    <td>{{ $transaction->payment_date }}</td>
                                    <td>{{ $transaction->payment_description }}</td>
                                    <td>{{ $transaction->debit }}</td>
                                    <td>{{ $transaction->credit }}</td>
                                    {{-- <td>{{ $transaction->payer_name }}</td> --}}
                                    <td>{{ $transaction->payer_inn }}</td>
                                    <td>{{ $transaction->payer_mfo }}</td>
                                    {{-- <td>{{ $transaction->payer_bank }}</td> --}}
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
                <!--end row-->
            </div>
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
