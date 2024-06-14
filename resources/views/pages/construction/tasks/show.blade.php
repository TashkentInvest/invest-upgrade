@extends('layouts.admin')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Detail</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-16">ART / # 12345</h4>
                        <div class="mb-4">
                            {{-- <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo" height="20" /> --}}
                           <h3>Obyekt</h3>
                        </div>
                    </div>
                    <hr>
                    {{-- <div class="row">
                        <div class="col-sm-6">
                            <address>
                                <strong>Billed To:</strong><br>
                                John Smith<br>
                                1234 Main<br>
                                Apt. 4B<br>
                                Springfield, ST 54321
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <address class="mt-2 mt-sm-0">
                                <strong>Shipped To:</strong><br>
                                Kenny Rigdon<br>
                                1234 Main<br>
                                Apt. 4B<br>
                                Springfield, ST 54321
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <address>
                                <strong>Payment Method:</strong><br>
                                Visa ending **** 4242<br>
                                jsmith@email.com
                            </address>
                        </div>
                        <div class="col-sm-6 mt-3 text-sm-end">
                            <address>
                                <strong>Order Date:</strong><br>
                                October 16, 2019<br><br>
                            </address>
                        </div>
                    </div> --}}
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 fw-bold">Obyekt Malumotlari</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <tbody>
                                <tr>
                                    <td>@lang('global.fio')</td>
                                    <td colspan="2">{{ $construction->last_name }} {{ $construction->first_name }}
                                        {{ $construction->father_name }}</td>
                                </tr>
                                @if ($construction->mijoz_turi == 'fizik')
    
                                    <tr>
                                        <td>{{ __('global.passport_pinfl') }}</td>
                                        <td>{{ $construction->passport->passport_pinfl }}</td>
                                    </tr>
    
                                    <tr>
                                        <td>{{ __('global.passport_serial') }}</td>
                                        <td>{{ $construction->passport->passport_serial }}</td>
                                    </tr>
    
                                    <tr>
                                        @if ($construction->passport->passport_date)
                                            <td>@lang('cruds.client.fields.passport_date')</td>
                                            <td>{{ date('d-m-Y', strtotime($construction->passport->passport_date)) }}</td>
                                        @else
                                            <td>@lang('cruds.client.fields.passport->passport_date')</td>
                                            <td></td>
                                        @endif
                                    </tr>
    
    
                                    <tr>
                                        <td>@lang('cruds.client.fields.passport_location')</td>
                                        <td>{{ $construction->passport->passport_location }}</td>
                                    </tr>
    
    
    
                                    <tr>
                                        <td>@lang('global.home_address')</td>
                                        <td colspan="2">{{ $construction->address->home_address }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>@lang('cruds.client.fields.yuridik_address')</td>
                                        <td colspan="2">{{ $construction->address->yuridik_address }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.company.fields.company_name')</td>
                                        <td colspan="2">{{ $construction->company->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.company.fields.oked')</td>
                                        <td colspan="2">{{ $construction->company->oked }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.company.fields.raxbar')</td>
                                        <td colspan="2">{{ $construction->company->raxbar }}</td>
                                    </tr>
    
                                    <tr>
                                        <td>@lang('cruds.company.fields.bank_code')</td>
                                        <td colspan="2">{{ $construction->company->bank_code }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.company.fields.bank_service')</td>
                                        <td colspan="2">{{ $construction->company->bank_service }}</td>
                                    </tr>
                                @endif
    
                                <tr>
                                    <td>@lang('cruds.company.fields.stir')</td>
                                    <td colspan="2">{{ $construction->company->stir }}</td>
                                </tr>
    
                                @foreach ($construction->branches as $b)
                                   
                                    <tr>
                                        <td>@lang('global.ruxsatnoma_raqami')</td>
                                        <td colspan="2">{{ $b->contract_apt }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('global.created_at')</td>
                                        <td colspan="2">{{ $b->contract_date }}</td>
                                    </tr>
    
                                    <tr>
                                        <td>@lang('cruds.branches.fields.application_number')</td>
                                        <td colspan="2">{{ $b->application_number }}</td>
                                    </tr>
    
                                    <tr>
                                        <td>@lang('global.loyiha_nomi')</td>
                                        <td colspan="2">{{ $b->branch_type }}</td>
                                    </tr>
    
    
                                    <tr>
                                        <td>@lang('cruds.company.fields.branch_type')</td>
                                        <td colspan="2">{{ $b->branch_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.company.fields.branch_location')</td>
                                        <td colspan="2">{{ $b->branch_location }}</td>
                                    </tr>
                                  
                                    <tr>
                                        <td>@lang('global.obyekt_boyicha_tolanishi_lozim') ( m³ )</td>
                                        <td colspan="2">{{ number_format($b->branch_kubmetr, 1) }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('global.jami_tolanishi_kerak')</td>
                                        <td colspan="2" id="payedSumCell1">{{ $b->generate_price }}</td>
                                    </tr>
    
                                    <script>
                                        function formatNumberWithSpaces(number) {
                                            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                                        }
    
                                        var payedSumElement = document.getElementById('payedSumCell1');
                                        var payedSumValue = payedSumElement.textContent;
    
                                        payedSumElement.textContent = formatNumberWithSpaces(payedSumValue);
                                    </script>
    
                                    <tr>
                                        <td>@lang('global.bolib_tolash_foizi_oldindan')</td>
                                        <td colspan="2">{{ $b->percentage_input }}%</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('global.quarterly_payment')</td>
                                        <td colspan="2">{{ $b->installment_quarterly }}</td>
                                    </tr>
    
                                    <tr>
                                        <td>@lang('global.bolib_tolash')</td>
                                        <td colspan="2">
                                            @if ($b->payment_type == 'pay_bolib')
                                                @lang('global.pay_bolib')
                                            @else
                                                @lang('global.pay_full')
                                            @endif
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>@lang('cruds.branches.fields.payed_sum')</td>
                                        <td colspan="2" id="payedSumCell">{{ $b->payed_sum }}</td>
                                    </tr>
    
                                    <script>
                                        function formatNumberWithSpaces(number) {
                                            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                                        }
    
                                        var payedSumElement = document.getElementById('payedSumCell');
                                        var payedSumValue = payedSumElement.textContent;
    
                                        payedSumElement.textContent = formatNumberWithSpaces(payedSumValue);
                                    </script>
    
                                    <tr>
                                        <td>@lang('cruds.branches.fields.payed_date')</td>
                                        <td colspan="2">{{ $b->payed_date }}</td>
                                    </tr>
    
                                    <tr>
                                        <td>@lang('cruds.branches.fields.notification_num')</td>
                                        <td colspan="2">{{ $b->notification_num }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.branches.fields.notification_date')</td>
                                        <td colspan="2">{{ $b->notification_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.branches.fields.insurance_policy')</td>
                                        <td colspan="2">{{ $b->insurance_policy }}</td>
                                    </tr>
    
                                    <tr>
                                        <td>@lang('cruds.branches.fields.bank_guarantee')</td>
                                        <td colspan="2">{{ $b->bank_guarantee }}</td>
                                    </tr>
    
                                @endforeach
    
                            </tbody>
                        </table>
    
                    </div>
                    <div class="d-print-none">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i
                                    class="fa fa-print"></i></a>
                            <a href="{{route('construction.edit', $construction->id)}}" class="btn btn-primary w-md waves-effect waves-light">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
