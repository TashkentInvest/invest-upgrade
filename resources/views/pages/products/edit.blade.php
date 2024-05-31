@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">@lang('cruds.branches.title')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('productIndex') }}"
                                style="color: #007bff;">@lang('cruds.branches.title')</a></li>
                        <li class="breadcrumb-item active">@lang('global.edit')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('global.edit')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('productUpdate', ['id' => $product->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information -->
                        <h3>@lang('global.personal_informations')</h3>
                        <section>
                            <!-- Client Details -->
                            <div class="row">
                                <div class="col-12 col-lg-12 mb-2">
                                    <label for="mijoz_turi" class="col-md-6 col-form-label">@lang('cruds.client.fields.mijoz_turi')</label>
                                    <select class="form-control" name="mijoz_turi" id="mijoz_turi">
                                        <option value="fizik">@lang('cruds.client.fields.mijoz_turi_fizik')</option>
                                        <option value="yuridik">@lang('cruds.client.fields.mijoz_turi_yuridik')</option>
                                    </select>
                                    @if ($errors->has('mijoz_turi'))
                                        <span class="error invalid-feedback">{{ $errors->first('mijoz_turi') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="company_name" class="col-md-6 col-form-label">@lang('cruds.company.fields.company_name')</label>
                                    <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                        type="text" name="company_name" id="company_name"
                                        placeholder="@lang('cruds.company.fields.company_name')"
                                        value="{{ old('company_name', $client->company_name) }}">
                                    @if ($errors->has('company_name'))
                                        <span class="error invalid-feedback">{{ $errors->first('company_name') }}</span>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="raxbar" class="col-md-6 col-form-label">@lang('cruds.company.fields.raxbar')</label>
                                    <input class="form-control {{ $errors->has('raxbar') ? 'is-invalid' : '' }}"
                                        type="text" name="raxbar" id="raxbar" placeholder="@lang('cruds.company.fields.raxbar')"
                                        value="{{ old('raxbar', $client->raxbar) }}">
                                    @if ($errors->has('raxbar'))
                                        <span class="error invalid-feedback">{{ $errors->first('raxbar') }}</span>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="yuridik_address" class="col-md-6 col-form-label">@lang('cruds.client.fields.yuridik_address')</label>
                                    <input class="form-control {{ $errors->has('yuridik_address') ? 'is-invalid' : '' }}"
                                        type="text" name="yuridik_address" id="yuridik_address"
                                        placeholder="@lang('cruds.client.fields.yuridik_address')"
                                        value="{{ old('yuridik_address', $client->yuridik_address) }}">
                                    @if ($errors->has('yuridik_address'))
                                        <span class="error invalid-feedback">{{ $errors->first('yuridik_address') }}</span>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="yuridik_rekvizid" class="col-md-6 col-form-label">@lang('cruds.client.fields.yuridik_rekvizid')</label>
                                    <input class="form-control {{ $errors->has('yuridik_rekvizid') ? 'is-invalid' : '' }}"
                                        type="text" name="yuridik_rekvizid" id="yuridik_rekvizid"
                                        placeholder="@lang('cruds.client.fields.yuridik_rekvizid')"
                                        value="{{ old('yuridik_rekvizid', $client->yuridik_rekvizid) }}">
                                    @if ($errors->has('yuridik_rekvizid'))
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('yuridik_rekvizid') }}</span>
                                    @endif
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="last_name" class="col-md-6 col-form-label">@lang('cruds.client.fields.last_name')</label>
                                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                        type="text" name="last_name" id="last_name" placeholder="@lang('cruds.client.fields.last_name')"
                                        value="{{ old('last_name', $client->last_name) }}">
                                    @if ($errors->has('last_name'))
                                        <span class="error invalid-feedback">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="name" class="col-md-6 col-form-label">@lang('cruds.client.fields.name')</label>
                                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                        type="text" name="first_name" id="first_name" placeholder="@lang('cruds.client.fields.first_name')"
                                        value="{{ old('first_name', $client->first_name) }}">
                                    @if ($errors->has('first_name'))
                                        <span class="error invalid-feedback">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="father_name" class="col-md-6 col-form-label">@lang('cruds.client.fields.father_name')</label>
                                    <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                                        type="text" name="father_name" id="father_name"
                                        placeholder="@lang('cruds.client.fields.father_name')"
                                        value="{{ old('father_name', $client->father_name) }}">
                                    @if ($errors->has('father_name'))
                                        <span class="error invalid-feedback">{{ $errors->first('father_name') }}</span>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="contact" class="col-md-6 col-form-label">@lang('cruds.client.fields.contact')</label>
                                    <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}"
                                        type="text" name="contact" id="contact" placeholder="@lang('cruds.client.fields.contact')"
                                        value="{{ old('contact', $client->contact) }}">
                                    @if ($errors->has('contact'))
                                        <span class="error invalid-feedback">{{ $errors->first('contact') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row" id="passport" style="align-items: center ">

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="passport_serial"
                                        class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_serial')</label>
                                    <input class="form-control {{ $errors->has('passport_serial') ? 'is-invalid' : '' }}"
                                        type="text" name="passport_serial" id="passport_serial"
                                        placeholder="@lang('cruds.client.fields.passport_serial')"
                                        value="{{ old('passport_serial', $client->passport_serial) }}">
                                    @if ($errors->has('passport_serial'))
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('passport_serial') }}</span>
                                    @endif
                                </div>


                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="passport_pinfl" class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_pinfl')</label>
                                    <input class="form-control {{ $errors->has('passport_pinfl') ? 'is-invalid' : '' }}"
                                        type="text" name="passport_pinfl" id="passport_pinfl"
                                        placeholder="@lang('cruds.client.fields.passport_pinfl')"
                                        value="{{ old('passport_pinfl', $client->passport_pinfl) }}">
                                    @if ($errors->has('passport_pinfl'))
                                        <span class="error invalid-feedback">{{ $errors->first('passport_pinfl') }}</span>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="passport_date" class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_date')</label>
                                    <input class="form-control {{ $errors->has('passport_date') ? 'is-invalid' : '' }}"
                                        type="date" name="passport_date" id="passport_date"
                                        placeholder="@lang('cruds.client.fields.passport_date')"
                                        value="{{ old('passport_date', $client->passport_date) }}">
                                    @if ($errors->has('passport_date'))
                                        <span class="error invalid-feedback">{{ $errors->first('passport_date') }}</span>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label for="passport_location"
                                        class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_location')</label>
                                    <input
                                        class="form-control {{ $errors->has('passport_location') ? 'is-invalid' : '' }}"
                                        type="text" name="passport_location" id="passport_location"
                                        placeholder="@lang('cruds.client.fields.passport_location')"
                                        value="{{ old('passport_location', $client->passport_location) }}">
                                    @if ($errors->has('passport_location'))
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('passport_location') }}</span>
                                    @endif
                                </div>


                                <div class="col-12 col-lg-3 mb-2">

                                    <label for="is_passport_id" class="col-md-6 col-form-label">Is passport ID?</label>
                                    <input type="checkbox" name="passport_type" id="is_passport_id" value="1">

                                </div>
                            </div>




                            <div class="row" id="make_hide">

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

                        </section>
                        <!-- Object -->
                        {{-- <h3>@lang('global.object')</h3> --}}
                        <section>
                            <!-- Company Details -->
                            <div class="row">
                                @foreach ($product->client->companies as $companyIndex => $comp)
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="company_type">@lang('global.loyiha_turi')</label>
                                                <input type="text" class="form-control" id="company_type"
                                                    name="accordions[{{ $companyIndex }}][company_type]"
                                                    value="{{ old('accordions.' . $companyIndex . '.company_type', $comp->company_type) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="company_location">@lang('cruds.company.fields.company_location')</label>
                                                <input type="text" class="form-control" id="company_location"
                                                    name="accordions[{{ $companyIndex }}][company_location]"
                                                    value="{{ old('accordions.' . $companyIndex . '.company_location', $comp->company_location) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="company_name">@lang('global.loyiha_nomi')</label>
                                                <input type="text" class="form-control" id="company_name"
                                                    name="accordions[{{ $companyIndex }}][company_name]"
                                                    value="{{ old('accordions.' . $companyIndex . '.company_name', $comp->company_name) }}">
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3 mb-2">
                                            <label for="bank_service"
                                                class="col-md-6 col-form-label">@lang('cruds.company.fields.bank_service')</label>
                                            <input
                                                class="form-control {{ $errors->has('bank_service') ? 'is-invalid' : '' }}"
                                                type="text" name="accordions[{{ $companyIndex }}][bank_service]"
                                                id="bank_service" placeholder="@lang('cruds.company.fields.bank_service')"
                                                value="{{ old('accordions.' . $companyIndex . '.bank_service', $comp->bank_service) }}">
                                            @if ($errors->has('accordions.' . $companyIndex . '.bank_service'))
                                                <span
                                                    class="error invalid-feedback">{{ $errors->first('accordions.' . $companyIndex . '.bank_service') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12 col-lg-3 mb-2">
                                            <label for="bank_code"
                                                class="col-md-6 col-form-label">@lang('cruds.company.fields.bank_code')</label>
                                            <input
                                                class="form-control {{ $errors->has('bank_code') ? 'is-invalid' : '' }}"
                                                type="text" name="accordions[{{ $companyIndex }}][bank_code]"
                                                id="bank_code" placeholder="@lang('cruds.company.fields.bank_code')" maxlength="5"
                                                value="{{ old('accordions.' . $companyIndex . '.bank_code', $comp->bank_code) }}">
                                            @if ($errors->has('accordions.' . $companyIndex . '.bank_code'))
                                                <span
                                                    class="error invalid-feedback">{{ $errors->first('accordions.' . $companyIndex . '.bank_code') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12 col-lg-3 mb-2">
                                            <label for="stir"
                                                class="col-md-6 col-form-label">@lang('cruds.company.fields.stir')</label>
                                            <input class="form-control {{ $errors->has('stir') ? 'is-invalid' : '' }}"
                                                type="text" name="accordions[{{ $companyIndex }}][stir]"
                                                id="stir" placeholder="@lang('cruds.company.fields.stir')"
                                                value="{{ old('accordions.' . $companyIndex . '.stir', $comp->stir) }}">
                                            @if ($errors->has('accordions.' . $companyIndex . '.stir'))
                                                <span
                                                    class="error invalid-feedback">{{ $errors->first('accordions.' . $companyIndex . '.stir') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12 col-lg-3 mb-2">
                                            <label for="oked"
                                                class="col-md-6 col-form-label">@lang('cruds.company.fields.oked')</label>
                                            <input class="form-control {{ $errors->has('oked') ? 'is-invalid' : '' }}"
                                                type="text" name="accordions[{{ $companyIndex }}][oked]"
                                                id="oked" placeholder="@lang('cruds.company.fields.oked')"
                                                value="{{ old('accordions.' . $companyIndex . '.oked', $comp->oked) }}">
                                            @if ($errors->has('accordions.' . $companyIndex . '.oked'))
                                                <span
                                                    class="error invalid-feedback">{{ $errors->first('accordions.' . $companyIndex . '.oked') }}</span>
                                            @endif
                                        </div>


                                        @foreach ($comp->branches as $branchIndex => $b)
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="notification_num">@lang('cruds.branches.fields.notification_num')</label>
                                                        <input type="text" class="form-control"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][notification_num]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.notification_num', $b->notification_num) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="notification_date">@lang('cruds.branches.fields.notification_date')</label>
                                                        <input type="text" class="form-control"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][notification_date]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.notification_date', $b->notification_date) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="insurance_policy">@lang('cruds.branches.fields.insurance_policy')</label>
                                                        <input type="text" class="form-control"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][insurance_policy]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.insurance_policy', $b->insurance_policy) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="bank_guarantee">@lang('cruds.branches.fields.bank_guarantee')</label>
                                                        <input type="text" class="form-control"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][bank_guarantee]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.bank_guarantee', $b->bank_guarantee) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="application_number">@lang('cruds.branches.fields.application_number')</label>
                                                        <input type="text" class="form-control"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][application_number]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.application_number', $b->application_number) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="payed_sum">@lang('cruds.branches.fields.payed_sum')</label>
                                                        <input type="text" class="form-control"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][payed_sum]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.payed_sum', $b->payed_sum) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="payed_date">@lang('cruds.branches.fields.payed_date')</label>
                                                        <input type="text" class="form-control"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][payed_date]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.payed_date', $b->payed_date) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="contract_apt">@lang('global.ruxsatnoma_raqami')</label>
                                                        <input type="text" class="form-control" id="contract_apt"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][contract_apt]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.contract_apt', $b->contract_apt) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="contract_date">@lang('global.sanasi')</label>
                                                        <input class="form-control" type="datetime-local"
                                                            id="contract_date"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][contract_date]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.contract_date', $b->contract_date) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="branch_kubmetr">@lang('global.obyekt_boyicha_tolanishi_lozim')</label>
                                                        <input type="text" class="form-control" id="branch_kubmetr"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][branch_kubmetr]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.branch_kubmetr', $b->branch_kubmetr) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="minimum_wage">@lang('global.bazaviy_xisoblash_miqdori')</label>
                                                        <input type="text" class="form-control" id="minimum_wage"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][minimum_wage]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.minimum_wage', $b->minimum_wage) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="generate_price">@lang('global.total_amount')</label>
                                                        <input type="text" class="form-control" id="generate_price"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][generate_price]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.generate_price', $b->generate_price) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="payment_type">@lang('global.tolash_turlari')</label>
                                                        <select class="form-select" id="payment_type"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][payment_type]">
                                                            <option value="pay_full"
                                                                {{ $b->payment_type == 'pay_full' ? 'selected' : '' }}>
                                                                @lang('global.toliq_xajimda_tolash')
                                                            </option>
                                                            <option value="pay_bolib"
                                                                {{ $b->payment_type == 'pay_bolib' ? 'selected' : '' }}>
                                                                @lang('global.bolib_tolash')
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="percentage_input">@lang('global.bolib_tolash_foizi_oldindan')</label>
                                                        <input type="text" class="form-control" id="percentage_input"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][percentage_input]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.percentage_input', $b->percentage_input) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="installment_quarterly">@lang('global.bolib_tolash_har_chorakda')</label>
                                                        <input type="text" class="form-control"
                                                            id="installment_quarterly"
                                                            name="accordions[{{ $companyIndex }}][branches][{{ $branchIndex }}][installment_quarterly]"
                                                            value="{{ old('accordions.' . $companyIndex . '.branches.' . $branchIndex . '.installment_quarterly', $b->installment_quarterly) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                @endforeach

                                <div class="col-12 col-lg-12 mb-2">
                                    <label for="client_description"
                                        class="col-md-6 col-form-label">@lang('cruds.client.fields.client_description')</label>
                                    <textarea id="textarea" name="client_description"
                                        class="form-control {{ $errors->has('client_description') ? 'is-invalid' : '' }}" maxlength="225"
                                        rows="3" placeholder="This textarea has a limit of 225 chars.">{{ old('client_description', $client->description) }}</textarea>
                                    @if ($errors->has('client_description'))
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('client_description') }}</span>
                                    @endif
                                </div>


                                <h4>@lang('global.downloadFile')</h4>
                                <div class="col-12 col-lg-3 mb-2">
                                    <!-- Allow users to upload additional files -->
                                    <h6>Ruxsatnoma | Shartnoma</h6>
                                    <input type="file" name="document[]" multiple>
                                    @if ($errors->has('document'))
                                        <span class="error invalid-feedback">{{ $errors->first('document') }}</span>
                                    @endif
                                </div>
                                <!-- Display existing files -->
                                <ul>
                                    @foreach ($files as $file)
                                        <div class="py-1">
                                            <a target="_blank" class="py-2 my-2"
                                                href="{{ asset($file->path) }}">{{ $file->path }}</a>
                                            @can('client.delete')
                                                Delete
                                                <input type="checkbox" name="delete_files[]" value="{{ $file->id }}">
                                            @endcan
                                        </div>
                                    @endforeach
                                </ul>

                        </section>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">@lang('global.update')</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
    </div>
@endsection
