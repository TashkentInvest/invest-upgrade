@extends('layouts.app')

@section('content')
    <style>
        .wizard .steps .current a,
        .wizard .steps .current a:active,
        .wizard .steps .current a:hover {
            background-color: rgba(85, 110, 230, .2);
            color: var(--bs-gray-700);
            display: none !important;
        }

        .accordion-body {
            padding: 0 !important;
        }

        @media(max-width: 774px) {
            .media_text {
                font-size: 15px;
                font-weight: bold
            }
        }
    </style>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <!-- Include Select2 CSS -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

 <!-- Include Select2 JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    


    <div class="row">
        <h3 class="text-center media_text">Архитектура-Режалаштириш Топшириғи берилгани учун белгиланган
            қўшимча йиғим тўловини амалга ошириш учун Тошкент Инвест Компанияси билан Шартнома тузишга керак бўлган
            маълумотлар:</h3>
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <form id='myForm' action="{{ route('clientCreate') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="created_by_client" value="1">

                        <div id="basic-example">
                            <h3>@lang('global.personal_informations')</h3>
                            <section>

                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="mijoz_turi" class="col-md-4 col-form-label">@lang('cruds.client.fields.mijoz_turi')</label>
                                        <select class="form-control" name="mijoz_turi" id="mijoz_turi">
                                            <option value="fizik" {{ old('mijoz_turi') == 'fizik' ? 'selected' : '' }}>
                                                @lang('cruds.client.fields.mijoz_turi_fizik')</option>
                                            <option value="yuridik" {{ old('mijoz_turi') == 'yuridik' ? 'selected' : '' }}>
                                                @lang('cruds.client.fields.mijoz_turi_yuridik')</option>
                                        </select>
                                        @error('mijoz_turi')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="category_id" class="col-md-4 col-form-label">@lang('global.category')</label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row" id="make_show" style="display: none;">

                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="company_name" class="col-md-6 col-form-label">@lang('cruds.company.fields.company_name')</label>
                                        <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                            type="text" name="company_name" id="company_name"
                                            placeholder="@lang('cruds.company.fields.company_name')" value="{{ old('company_name') }}">
                                        @if ($errors->has('company_name'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('company_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="raxbar" class="col-md-6 col-form-label">@lang('cruds.company.fields.raxbar') -
                                            @lang('global.client_name')</label>
                                        <input class="form-control {{ $errors->has('raxbar') ? 'is-invalid' : '' }}"
                                            type="text" name="raxbar" id="raxbar" placeholder="@lang('cruds.company.fields.raxbar')"
                                            value="{{ old('raxbar') }}">
                                        @if ($errors->has('raxbar'))
                                            <span class="error invalid-feedback">{{ $errors->first('raxbar') }}</span>
                                        @endif
                                    </div>



                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="oked" class="col-md-6 col-form-label">@lang('cruds.company.fields.oked')</label>
                                        <input class="form-control {{ $errors->has('oked') ? 'is-invalid' : '' }}"
                                            type="number" name="oked" id="oked" placeholder="@lang('cruds.company.fields.oked')"
                                            value="{{ old('oked') }}" minlength="5" maxlength="5">
                                        @if ($errors->has('oked'))
                                            <span class="error invalid-feedback">{{ $errors->first('oked') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="bank_service" class="col-md-6 col-form-label">@lang('cruds.company.fields.bank_service')</label>
                                        <input class="form-control {{ $errors->has('bank_service') ? 'is-invalid' : '' }}"
                                            type="text" name="bank_service" id="bank_service"
                                            placeholder="@lang('cruds.company.fields.bank_service')" value="{{ old('bank_service') }}">
                                        @if ($errors->has('bank_service'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('bank_service') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="bank_code" class="col-md-6 col-form-label">@lang('cruds.company.fields.bank_code')</label>
                                        <input class="form-control {{ $errors->has('bank_code') ? 'is-invalid' : '' }}"
                                            type="number" name="bank_code" id="bank_code" placeholder="@lang('cruds.company.fields.bank_code')"
                                            value="{{ old('bank_code') }}" minlength="5" maxlength="5" name="bank_code"
                                            id="bank_code">

                                        @if ($errors->has('bank_code'))
                                            <span class="error invalid-feedback">{{ $errors->first('bank_code') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="bank_account" class="col-md-6 col-form-label">@lang('cruds.company.fields.bank_account')</label>
                                        <input class="form-control {{ $errors->has('bank_account') ? 'is-invalid' : '' }}"
                                            type="number" name="bank_account" id="bank_account"
                                            placeholder="@lang('cruds.company.fields.bank_account')" value="{{ old('bank_account') }}"
                                            minlength="20" maxlength="20" name="bank_account" id="alloptions">

                                        @if ($errors->has('bank_account'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('bank_account') }}</span>
                                        @endif
                                    </div>


                                    <div class="col-12 col-lg-12 mb-2">
                                        <label for="yuridik_address"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.yuridik_address')</label>
                                        <input
                                            class="form-control {{ $errors->has('yuridik_address') ? 'is-invalid' : '' }}"
                                            type="text" name="yuridik_address" id="yuridik_address"
                                            placeholder="@lang('cruds.client.fields.yuridik_address')" value="{{ old('yuridik_address') }}">
                                        @if ($errors->has('yuridik_address'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('yuridik_address') }}</span>
                                        @endif
                                    </div>

                                    {{-- <div class="col-12 col-lg-4 mb-2">
                                        <label for="yuridik_rekvizid"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.yuridik_rekvizid')</label>
                                        <input
                                            class="form-control {{ $errors->has('yuridik_rekvizid') ? 'is-invalid' : '' }}"
                                            type="text" name="yuridik_rekvizid" id="yuridik_rekvizid"
                                            placeholder="@lang('cruds.client.fields.yuridik_rekvizid')" value="{{ old('yuridik_rekvizid') }}">
                                        @if ($errors->has('yuridik_rekvizid'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('yuridik_rekvizid') }}</span>
                                        @endif
                                    </div> --}}

                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-2">
                                        <label for="last_name" class="col-md-4 col-form-label">@lang('cruds.client.fields.last_name')</label>
                                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                            type="text" name="last_name" id="last_name"
                                            placeholder="@lang('cruds.client.fields.last_name')" value="{{ old('last_name') }}">
                                        @if ($errors->has('last_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-2">
                                        <label for="name" class="col-md-4 col-form-label">@lang('cruds.client.fields.name')</label>
                                        <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                            type="text" name="first_name" id="first_name"
                                            placeholder="@lang('cruds.client.fields.first_name')" value="{{ old('first_name') }}">
                                        @if ($errors->has('first_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>



                                    <div class="col-12 col-md-4 col-lg-4 col-xl-4 mb-2">
                                        <label for="father_name"
                                            class="col-md-4 col-form-label">@lang('cruds.client.fields.father_name')</label>
                                        <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                                            type="text" name="father_name" id="father_name"
                                            placeholder="@lang('cruds.client.fields.father_name')" value="{{ old('father_name') }}">
                                        @if ($errors->has('father_name'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('father_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-6 col-xl-6 mb-2">
                                        <label for="contact" class="col-md-4 col-form-label">@lang('cruds.client.fields.contact')</label>
                                        <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}"
                                            type="text" name="contact" id="contact"
                                            placeholder="@lang('cruds.client.fields.contact')" value="{{ old('contact') }}">
                                        @if ($errors->has('contact'))
                                            <span class="error invalid-feedback">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-6 col-xl-6 mb-2">
                                        <label for="stir" class="col-md-6 col-form-label">@lang('cruds.company.fields.stir')</label>
                                        <input class="form-control {{ $errors->has('stir') ? 'is-invalid' : '' }}"
                                            type="number" name="stir" id="stir"
                                            placeholder="@lang('cruds.company.fields.stir')" value="{{ old('stir') }}" minlength="9"
                                            maxlength="9">
                                        @if ($errors->has('stir'))
                                            <span class="error invalid-feedback">{{ $errors->first('stir') }}</span>
                                        @endif
                                    </div>

                                </div>
                                {{-- <input type="hidden" name="client_id" value="{{$client->id}}"> --}}

                                <div class="row" id="make_hide">

                                    <div class="col-12 col-md-6 col-lg-6 col-xl-3 mb-2">
                                        <label for="passport_serial"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_serial')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_serial') ? 'is-invalid' : '' }}"
                                            type="text" name="passport_serial" id="passport_serial"
                                            placeholder="@lang('cruds.client.fields.passport_serial')" value="{{ old('passport_serial') }}"
                                            minlength="9" maxlength="10">
                                        @if ($errors->has('passport_serial'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_serial') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6 col-xl-3 mb-2">
                                        <label for="passport_pinfl"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_pinfl')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_pinfl') ? 'is-invalid' : '' }}"
                                            type="number" name="passport_pinfl" id="passport_pinfl"
                                            placeholder="@lang('cruds.client.fields.passport_pinfl')" value="{{ old('passport_pinfl') }}"
                                            minlength="14" maxlength="14">
                                        @if ($errors->has('passport_pinfl'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_pinfl') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6 col-xl-3 mb-2">
                                        <label for="passport_date"
                                            class="col-md-4 col-form-label">@lang('cruds.client.fields.passport_date')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_date') ? 'is-invalid' : '' }}"
                                            type="date" name="passport_date" id="passport_date"
                                            placeholder="@lang('cruds.client.fields.passport_date')" value="{{ old('passport_date') }}">
                                        @if ($errors->has('passport_date'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_date') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6 col-xl-3 mb-2">
                                        <label for="passport_location"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_location')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_location') ? 'is-invalid' : '' }}"
                                            type="text" name="passport_location" id="passport_location"
                                            placeholder="@lang('cruds.client.fields.passport_location')" value="{{ old('passport_location') }}">
                                        @if ($errors->has('passport_location'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_location') }}</span>
                                        @endif
                                    </div>





                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#myForm').on('keypress', function(e) {
                                            if (e.which === 13) {
                                                e.preventDefault();
                                            }
                                        });
                                    });
                                </script>

                                <script>
                                    $(document).ready(function() {
                                        $('#mijoz_turi').on('change', function() {
                                            if (this.value === 'fizik') {
                                                $('#make_hide').show();
                                                $('#make_show').hide();
                                            } else if (this.value === 'yuridik') {
                                                $('#make_hide').hide();
                                                $('#make_show').show();
                                            }
                                        }).trigger('change');
                                    });
                                </script>



                                <script>
                                    $(document).ready(function() {
                                        let accordionCount = 1;

                                        $('#addAccordion').on('click', function() {
                                            let accordion = $('.accordion-item').first().clone();
                                            let newId = 'flush-collapse' + accordionCount;
                                            accordion.find('.accordion-collapse').attr('id', newId);
                                            accordion.find('.accordion-button').attr('data-bs-target', '#' + newId);
                                            accordion.find('.accordion-header').attr('id', 'flush-heading' + accordionCount);
                                            accordion.find('.accordion-button').attr('aria-controls', newId);
                                            accordion.find('.accordion-button').text('Объект #' + accordionCount);

                                            accordion.find('input, select, textarea').each(function() {
                                                let name = $(this).attr('name');
                                                if (name) {
                                                    let newName = name.replace(/\[0\]/, '[' + accordionCount + ']');
                                                    $(this).attr('name', newName);
                                                }
                                                $(this).val('');
                                                $(this).attr('id', name + '-' + accordionCount);
                                            });

                                            let tableId = 'payment-table-' + accordionCount;
                                            let scheduleId = 'payment-schedule-' + accordionCount;
                                            let quarterlyTableId = 'quarterly-table-' + accordionCount;
                                            let quarterlyScheduleId = 'quarterly-schedule-' + accordionCount;

                                            accordion.find('.payment-table').attr('id', tableId);
                                            accordion.find('.payment-schedule').attr('id', scheduleId);
                                            accordion.find('.quarterly-table').attr('id', quarterlyTableId);
                                            accordion.find('.quarterly-payment-schedule').attr('id', quarterlyScheduleId);

                                            accordion.appendTo('#accordionFlushExample');
                                            accordionCount++;

                                            accordion.find('.generate_price').val('');
                                            accordion.find('.payment-type').val('pay_full').trigger('change');
                                            accordion.find('.percentage-input').val('0').prop('disabled', true);
                                            accordion.find('.quarterly-input').val('').prop('disabled', true);
                                            accordion.find('.calculated-quarterly-payment').val('');
                                            accordion.find('.payment-schedule').empty();
                                            accordion.find('.quarterly-payment-schedule').empty();
                                            accordion.find('.total-quarterly-payment').text('0.00');
                                        });

                                        $(document).on('input change', '.branch_kubmetr, .minimum_wage, .percentage-input, .quarterly-input',
                                            function() {
                                                let parentAccordion = $(this).closest('.accordion-body');
                                                calculateGeneratePrice(parentAccordion);
                                            });

                                        function calculateGeneratePrice(parentAccordion) {
                                            let companyKubmetr = parentAccordion.find('.branch_kubmetr').val();
                                            let minimumWage = parentAccordion.find('.minimum_wage').val();
                                            let generatePrice = companyKubmetr * minimumWage;
                                            parentAccordion.find('.generate_price').val(generatePrice);

                                            let percentageInput = parseFloat(parentAccordion.find('.percentage-input').val());
                                            let quarterlyInput = parseInt(parentAccordion.find('.quarterly-input').val());

                                            if (!isNaN(generatePrice) && !isNaN(percentageInput) && !isNaN(quarterlyInput) && quarterlyInput >
                                                0) {
                                                let z = (generatePrice * percentageInput) / 100;
                                                let n = generatePrice - z;
                                                let y = n / quarterlyInput;
                                                parentAccordion.find('.calculated-quarterly-payment').val(y.toFixed(2));

                                                updatePaymentSchedule(parentAccordion, generatePrice);
                                                updateQuarterlyPaymentSchedule(parentAccordion, y, quarterlyInput);
                                            }
                                        }

                                        function updatePaymentSchedule(parentAccordion, generatePrice) {
                                            let paymentSchedule = parentAccordion.find('.payment-schedule');
                                            paymentSchedule.empty();
                                            let percentages = [0, 10, 20, 30, 40, 50];
                                            percentages.forEach(percentage => {
                                                let z = Math.round((generatePrice * percentage) / 100);
                                                let n = generatePrice - z;
                                                let quarterlyInput = parentAccordion.find('.quarterly-input').val();
                                                let y = quarterlyInput ? Math.round((n / quarterlyInput)) : "N/A";
                                                paymentSchedule.append(
                                                    `<tr>
                                                        <td>${percentage}%</td>
                                                        <td>${Math.round(z)}</td>
                                                        <td>${y}</td>
                                                    </tr>`
                                                );
                                            });
                                        }

                                        $(document).on('change', '.payment-type', function() {
                                            let parentAccordion = $(this).closest('.accordion-body');
                                            let paymentType = $(this).val();
                                            let percentageInput = parentAccordion.find('.percentage-input');
                                            let quarterlyInput = parentAccordion.find('.quarterly-input');

                                            if (paymentType === 'pay_full') {
                                                percentageInput.val(100).prop('disabled', true);
                                                quarterlyInput.val('').prop('disabled', true);
                                                parentAccordion.find('.calculated-quarterly-payment').val('N/A');
                                                parentAccordion.find('.payment-schedule').empty();
                                                parentAccordion.find('.quarterly-payment-schedule').empty();
                                            } else {
                                                percentageInput.prop('disabled', false);
                                                quarterlyInput.prop('disabled', false);
                                            }

                                            calculateGeneratePrice(parentAccordion);
                                        });

                                        calculateGeneratePrice($('.accordion-item').first().find('.accordion-body'));
                                    });
                                </script>


                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                Объект #0
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body text-muted">
                                                <main class="main_of_objects">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="mb-3">
                                                                <label for="contract_apt">@lang('global.ruxsatnoma_raqami')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][contract_apt]"
                                                                    placeholder="@lang('global.ruxsatnoma_raqami')"
                                                                    value="{{ old('accordions.0.contract_apt') }}">
                                                                @error('accordions.0.contract_apt')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="mb-3">
                                                                <label for="contract_date">@lang('global.sanasi')</label>
                                                                <input class="form-control" type="date"
                                                                    name="accordions[0][contract_date]"
                                                                    value="{{ old('accordions.0.contract_date') }}">
                                                                @error('accordions.0.contract_date')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="notification_num">@lang('cruds.branches.fields.notification_num')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][notification_num]"
                                                                    placeholder="@lang('cruds.branches.fields.notification_num')"
                                                                    value="{{ old('accordions.0.notification_num') }}">

                                                                @error('accordions.0.notification_num')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="notification_date">@lang('cruds.branches.fields.notification_date')</label>
                                                                <input type="date" class="form-control"
                                                                    name="accordions[0][notification_date]"
                                                                    placeholder="@lang('cruds.branches.fields.notification_date')"
                                                                    value="{{ old('accordions.0.notification_date') }}">
                                                                @error('accordions.0.notification_date')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="insurance_policy">@lang('cruds.branches.fields.insurance_policy')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][insurance_policy]"
                                                                    placeholder="@lang('cruds.branches.fields.insurance_policy')"
                                                                    value="{{ old('accordions.0.insurance_policy') }}">
                                                                @error('accordions.0.insurance_policy')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="bank_guarantee">@lang('cruds.branches.fields.bank_guarantee')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][bank_guarantee]"
                                                                    placeholder="@lang('cruds.branches.fields.bank_guarantee')"
                                                                    value="{{ old('accordions.0.bank_guarantee') }}">
                                                                @error('accordions.0.bank_guarantee')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <!-- New fields -->
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    for="shaxarsozlik_umumiy_xajmi">@lang('global.shaxarsozlik_umumiy_xajmi')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][shaxarsozlik_umumiy_xajmi]"
                                                                    placeholder="@lang('global.shaxarsozlik_umumiy_xajmi')"
                                                                    value="{{ old('accordions.0.shaxarsozlik_umumiy_xajmi') }}">
                                                                @error('accordions.0.shaxarsozlik_umumiy_xajmi')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="mb-3">
                                                                <label for="qavatlar_soni_xajmi">@lang('global.qavatlar_soni_xajmi')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][qavatlar_soni_xajmi]"
                                                                    placeholder="@lang('global.qavatlar_soni_xajmi')"
                                                                    value="{{ old('accordions.0.qavatlar_soni_xajmi') }}">
                                                                @error('accordions.0.qavatlar_soni_xajmi')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="mb-3">
                                                                <label for="avtoturargoh_xajmi">@lang('global.avtoturargoh_xajmi')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][avtoturargoh_xajmi]"
                                                                    placeholder="@lang('global.avtoturargoh_xajmi')"
                                                                    value="{{ old('accordions.0.avtoturargoh_xajmi') }}">
                                                                @error('accordions.0.avtoturargoh_xajmi')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="mb-3">
                                                                <label for="qavat_xona_xajmi">@lang('global.qavat_xona_xajmi')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][qavat_xona_xajmi]"
                                                                    placeholder="@lang('global.qavat_xona_xajmi')"
                                                                    value="{{ old('accordions.0.qavat_xona_xajmi') }}">
                                                                @error('accordions.0.qavat_xona_xajmi')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    for="umumiy_foydalanishdagi_xajmi">@lang('global.umumiy_foydalanishdagi_xajmi')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][umumiy_foydalanishdagi_xajmi]"
                                                                    placeholder="@lang('global.umumiy_foydalanishdagi_xajmi')"
                                                                    value="{{ old('accordions.0.umumiy_foydalanishdagi_xajmi') }}">
                                                                @error('accordions.0.umumiy_foydalanishdagi_xajmi')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-3">
                                                                <label for="branch_location">@lang('cruds.company.fields.branch_location')</label>
                                                                <select class="form-control select2" name="accordions[0][branch_location]" id="branch_location">
                                                                    <option value="">@lang('cruds.company.fields.branch_location')</option>
                                                                    <option value="Metro bekatidan chiqish joyidan obyekt chegarasig‘acha 200 metr radius oralig‘i hududlardan boshqa hududlarda joylashgan loyihaviy binolar (inshootlar)" data-kt="0.6">
                                                                        Metro bekatidan chiqish joyidan obyekt chegarasig‘acha 200 metr radius oralig‘i hududlardan boshqa hududlarda joylashgan loyihaviy binolar (inshootlar)
                                                                    </option>
                                                                    <option value="Mazkur bo‘limning 1-qatorida ko‘rsatilmagan boshqa obyektlar" data-kt="1">
                                                                        Mazkur bo‘limning 1-qatorida ko‘rsatilmagan boshqa obyektlar
                                                                    </option>
                                                                </select>
                                                                @error('accordions.0.branch_location')
                                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-3">
                                                                <label for="branch_type">@lang('global.loyiha_turi')</label>
                                                                <select class="form-control select2" name="accordions[0][branch_type]" id="branch_type">
                                                                    <option value="">@lang('global.loyiha_turi')</option>
                                                                    <option value="Alohida turgan xususiy ijtimoiy infratuzilma va turizm obyektlari" data-kt="0.5">
                                                                        Alohida turgan xususiy ijtimoiy infratuzilma va turizm obyektlari
                                                                    </option>
                                                                    <option value="Davlat ulushi 50 (ellik) foizdan ortiq bo‘lgan davlat va (yoki) munitsipal mulk negizida amalga oshiriladigan investitsiya loyihalari doirasidagi obyektlar" data-kt="0.5">
                                                                        Davlat ulushi 50 (ellik) foizdan ortiq bo‘lgan davlat va (yoki) munitsipal mulk negizida amalga oshiriladigan investitsiya loyihalari doirasidagi obyektlar
                                                                    </option>
                                                                    <option value="Ishlab chiqarish korxonalarining umumiy ovqatlanish joylari, sport-sog‘lomlashtirish zallari (xonalari), ofislar va turar joylarni qurish, renovatsiya va rekonstruksiya qilish uchun" data-kt="0.5">
                                                                        Ishlab chiqarish korxonalarining umumiy ovqatlanish joylari, sport-sog‘lomlashtirish zallari (xonalari), ofislar va turar joylarni qurish, renovatsiya va rekonstruksiya qilish uchun
                                                                    </option>
                                                                    <option value="Omborxonalarni har bir qavati uchun 2 (ikki) metr balandlikdan oshmagan oʻlchamda (omborxonalarining ma’muriy-xo‘jalik majmuasi sifadida foydalaniladigan, alohida turgan kapital binolar, shu jumladan, umumiy ovqatlanish joylari, sport-sog‘lomlashtirish zallari (xonalari), ofislar, turar joylar bundan mustasno)" data-kt="0.5">
                                                                        Omborxonalarni har bir qavati uchun 2 (ikki) metr balandlikdan oshmagan oʻlchamda (omborxonalarining ma’muriy-xo‘jalik majmuasi sifadida foydalaniladigan, alohida turgan kapital binolar, shu jumladan, umumiy ovqatlanish joylari, sport-sog‘lomlashtirish zallari (xonalari), ofislar, turar joylar bundan mustasno)
                                                                    </option>
                                                                    <option value="Mazkur bo‘limning 1–5-qatorlarida ko‘rsatilmagan boshqa obyektlar" data-kt="1">
                                                                        Mazkur bo‘limning 1–5-qatorlarida ko‘rsatilmagan boshqa obyektlar
                                                                    </option>
                                                                </select>
                                                                @error('accordions.0.branch_type')
                                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-3">
                                                                <label for="qurilish_turi">@lang('global.qurilish_turi')</label>
                                                                <select class="form-control select2" name="accordions[0][qurilish_turi]" id="qurilish_turi">
                                                                    <option value="">@lang('global.qurilish_turi')</option>
                                                                    <option value="Yangi kapital qurilish" data-kt="1">
                                                                        Yangi kapital qurilish
                                                                    </option>
                                                                    <option value="Obyektni rekonstruksiya qilish (koeffitsiyent obyetkga qo‘shilgan qurilish hajmiga hisoblanadi)" data-kt="1">
                                                                        Obyektni rekonstruksiya qilish (koeffitsiyent obyetkga qo‘shilgan qurilish hajmiga hisoblanadi)
                                                                    </option>
                                                                    <option value="O‘zbekiston Respublikasi Shaharsozlik kodeksiga muvofiq loyiha-smeta hujjatlari ekpertizasi talab etilmaydigan obyektlarini rekonstruksiya qilish" data-kt="0">
                                                                        O‘zbekiston Respublikasi Shaharsozlik kodeksiga muvofiq loyiha-smeta hujjatlari ekpertizasi talab etilmaydigan obyektlarini rekonstruksiya qilish
                                                                    </option>
                                                                    <option value="Obyektni qurilish hajmini o‘zgartirmagan holda rekonstruksiya qilish" data-kt="0">
                                                                        Obyektni qurilish hajmini o‘zgartirmagan holda rekonstruksiya qilish
                                                                    </option>
                                                                </select>
                                                                @error('accordions.0.qurilish_turi')
                                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-3">
                                                                <label for="zona">@lang('global.zona')</label>
                                                                <select id="zona" class="form-control select2" name="accordions[0][zona]">
                                                                    <option value="">Zona</option>
                                                                    <option value="1" data-kt="1.40">1-zona</option>
                                                                    <option value="2" data-kt="1.25">2-zona</option>
                                                                    <option value="3" data-kt="1.00">3-zona</option>
                                                                    <option value="4" data-kt="0.75">4-zona</option>
                                                                    <option value="5" data-kt="0.50">5-zona</option>
                                                                </select>
                                                                @error('accordions.0.zona')
                                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="coefficient">@lang('global.coefficient')</label>
                                                                <input type="text" class="form-control" id="coefficient" name="accordions[0][coefficient]" readonly>
                                                            </div>
                                                        </div>
                                                      
                                                     

                                                        <!-- End new fields -->
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="application_number">@lang('cruds.branches.fields.application_number')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][application_number]"
                                                                    placeholder="@lang('cruds.branches.fields.application_number')"
                                                                    value="{{ old('accordions.0.application_number') }}">
                                                                @error('accordions.0.application_number')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="payed_sum">@lang('cruds.branches.fields.payed_sum')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][payed_sum]"
                                                                    placeholder="@lang('cruds.branches.fields.payed_sum')"
                                                                    value="{{ old('accordions.0.payed_sum') }}">
                                                                @error('accordions.0.payed_sum')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-12 col-lg-4 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="payed_date">@lang('cruds.branches.fields.payed_date')</label>
                                                                <input type="date" class="form-control"
                                                                    name="accordions[0][payed_date]"
                                                                    placeholder="@lang('cruds.branches.fields.payed_date')"
                                                                    value="{{ old('accordions.0.payed_date') }}">
                                                                @error('accordions.0.payed_date')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="inner-repeater mb-4">
                                                                <div data-repeater-list="inner-group" class="inner mb-3">
                                                                    <label
                                                                        for="basicpill-cardno-input">@lang('global.obyekt_boyicha_tolanishi_lozim')</label>
                                                                    <input type="number" step="0.00001"
                                                                        class="form-control branch_kubmetr"
                                                                        placeholder="( m³ )"
                                                                        name="accordions[0][branch_kubmetr]"
                                                                        value="{{ old('accordions.0.branch_kubmetr') }}"
                                                                        onchange="displayFiveDigitsAfterDecimal(this)">
                                                                    @error('accordions.0.branch_kubmetr')
                                                                        <span
                                                                            class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            function displayFiveDigitsAfterDecimal(inputField) {
                                                                var value = parseFloat(inputField.value);
                                                                var roundedValue = value.toFixed(5);
                                                                inputField.value = roundedValue;
                                                            }
                                                            
                                                            var selectElements = document.querySelectorAll('.select2');

                                                            selectElements.forEach(function(select) {
                                                                select.addEventListener('change', function() {
                                                                    var selectedOptions = select.selectedOptions;
                                                                    var coefficient = 1;

                                                                    for (var i = 0; i < selectedOptions.length; i++) {
                                                                        var kt = parseFloat(selectedOptions[i].dataset.kt);
                                                                        coefficient *= kt;
                                                                    }

                                                                    document.getElementById('coefficient').value = coefficient.toFixed(2);
                                                                });
                                                            });


                                                        </script>

                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="branch_name">@lang('global.loyiha_nomi')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][branch_name]"
                                                                    value="{{ old('accordions.0.branch_name') }}"
                                                                    placeholder="@lang('global.loyiha_nomi')">
                                                                @error('accordions.0.branch_name')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="mb-3">
                                                                <label for="branch_type">@lang('global.loyiha_turi')</label>
                                                                <input type="text" class="form-control"
                                                                    name="accordions[0][branch_type]"
                                                                    placeholder="@lang('global.loyiha_turi')"
                                                                    value="{{ old('accordions.0.branch_type') }}">
                                                                @error('accordions.0.branch_type')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> --}}
                                                   

                                                   
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="mb-3">
                                                                <label
                                                                    for="basicpill-card-verification-input">@lang('global.bazaviy_xisoblash_miqdori')</label>
                                                                <input type="number" class="form-control minimum_wage"
                                                                    placeholder="@lang('global.bazaviy_xisoblash_miqdori')"
                                                                    value="{{ old('minimum_wage', '340000') }}"
                                                                    name="minimum_wage">

                                                                @error('minimum_wage')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="mb-3">
                                                                <label
                                                                    for="basicpill-card-verification-input">@lang('global.jami_tolanishi_kerak')</label>
                                                                <input type="text" class="form-control generate_price"
                                                                    name="accordions[0][generate_price]"
                                                                    value="{{ old('accordions.0.generate_price') }}"
                                                                    placeholder="@lang('global.jami_tolanishi_kerak')" readonly>
                                                                @error('accordions.0.generate_price')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="mb-3">
                                                                <label>@lang('global.tolash_turlari')</label>
                                                                <select class="form-select payment-type"
                                                                    name="accordions[0][payment_type]">
                                                                    <option value="pay_full"
                                                                        {{ old('accordions.0.payment_type') == 'pay_full' ? 'selected' : '' }}>
                                                                        @lang('global.toliq_xajimda_tolash')</option>
                                                                    <option value="pay_bolib"
                                                                        {{ old('accordions.0.payment_type') == 'pay_bolib' ? 'selected' : '' }}>
                                                                        @lang('global.bolib_tolash')</option>
                                                                </select>
                                                                @error('accordions.0.payment_type')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="mb-3">
                                                                <label for="percentage-input">@lang('global.bolib_tolash_foizi_oldindan')</label>
                                                                <div class="input-group">
                                                                    <input type="number"
                                                                        class="form-control percentage-input"
                                                                        name="accordions[0][percentage_input]"
                                                                        value="{{ old('accordions.0.percentage_input') }}"
                                                                        min="0" max="100">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                @error('accordions.0.percentage_input')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="mb-3">
                                                                <label for="quarterly-input">@lang('global.bolib_tolash_har_chorakda')</label>
                                                                <input type="number" class="form-control quarterly-input"
                                                                    name="accordions[0][installment_quarterly]"
                                                                    value="{{ old('accordions.0.installment_quarterly') }}"
                                                                    placeholder="@lang('global.bolib_tolash_har_chorakda')" disabled>
                                                                @error('accordions.0.installment_quarterly')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                                                            <div class="mb-3">
                                                                <label
                                                                    for="calculated-quarterly-payment">@lang('global.quarterly_payment')</label>
                                                                <input type="text"
                                                                    class="form-control calculated-quarterly-payment"
                                                                    value="{{ old('accordions.0.calculated_quarterly_payment') }}"
                                                                    placeholder="@lang('global.quarterly_payment')" readonly>
                                                                @error('accordions.0.calculated_quarterly_payment')
                                                                    <span
                                                                        class="error invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                  

                                                </main>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="addAccordion" class="btn btn-primary mt-3">Добавить объект

                                </div>
                                <!-- Confirm Details -->
                                <button class="btn btn-success mt-3" type="submit">Save</button>

                        </div>
                    </form>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

        </div>
        <!-- end col -->
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-repeater.int.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>
@endsection