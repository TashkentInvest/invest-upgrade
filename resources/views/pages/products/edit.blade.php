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
                    <form action="{{ route('productUpdate', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information -->
                        <h3>@lang('global.personal_informations')</h3>
                        <section>
                            <!-- Client Details -->
                            <div class="row">
                                <!-- Client Type -->
                                <div class="col-12 col-lg-12 mb-2">
                                    <label for="mijoz_turi">@lang('cruds.client.fields.mijoz_turi')</label>
                                    <select class="form-control" name="mijoz_turi" id="mijoz_turi">
                                        <option value="fizik"
                                            {{ $product->client->mijoz_turi == 'fizik' ? 'selected' : '' }}>
                                            @lang('global.fizik')</option>
                                        <option value="yuridik"
                                            {{ $product->client->mijoz_turi == 'yuridik' ? 'selected' : '' }}>
                                            @lang('global.yuridik')</option>
                                    </select>
                                </div>
                                <!-- Other Client Details -->
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="first_name">@lang('cruds.client.fields.first_name')</label>
                                    <input class="form-control" type="text" id="first_name" name="first_name"
                                        value="{{ $product->client->first_name }}">
                                </div>
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="last_name">@lang('cruds.client.fields.last_name')</label>
                                    <input class="form-control" type="text" id="last_name" name="last_name"
                                        value="{{ $product->client->last_name }}">
                                </div>
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="father_name">@lang('cruds.client.fields.father_name')</label>
                                    <input class="form-control" type="text" id="father_name" name="father_name"
                                        value="{{ $product->client->father_name }}">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="passport_serial">@lang('cruds.client.fields.passport_serial')</label>
                                    <input class="form-control" type="text" id="passport_serial" name="passport_serial"
                                        value="{{ $product->client->passport_serial }}">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="passport_pinfl">@lang('cruds.client.fields.passport_pinfl')</label>
                                    <input class="form-control" type="text" id="passport_pinfl" name="passport_pinfl"
                                        value="{{ $product->client->passport_pinfl }}">
                                </div>
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="yuridik_address">@lang('cruds.client.fields.yuridik_address')</label>
                                    <input class="form-control" type="text" id="yuridik_address" name="yuridik_address"
                                        value="{{ $product->client->yuridik_address }}">
                                </div>
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="yuridik_rekvizid">@lang('cruds.client.fields.yuridik_rekvizid')</label>
                                    <input class="form-control" type="text" id="yuridik_rekvizid" name="yuridik_rekvizid"
                                        value="{{ $product->client->yuridik_rekvizid }}">
                                </div>
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="contact">@lang('cruds.client.fields.contact')</label>
                                    <input class="form-control" type="text" id="contact" name="contact"
                                        value="{{ $product->client->contact }}">
                                </div>
                            </div>
                        </section>

                        <!-- Object -->
                        <h3>@lang('global.object')</h3>
                        <section>
                            <!-- Company Details -->
                            <div class="row">
                                @foreach ($product->client->companies as $comp)
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="company_type">@lang('global.loyiha_turi')</label>
                                                <input type="text" class="form-control" id="company_type"
                                                    name="company_type" value="{{ $comp->company_type }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="company_location">@lang('cruds.company.fields.company_location')</label>
                                                <input type="text" class="form-control" id="company_location"
                                                    name="company_location" value="{{ $comp->company_location }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="company_name">@lang('global.project_name')</label>
                                                <input type="text" class="form-control" id="company_name"
                                                    name="company_name" value="{{ $comp->company_name }}">
                                            </div>
                                        </div>

                                    </div>

                                    @foreach ($comp->branches as $b)
                                        <!-- Contract Details -->
                                        <h3>@lang('global.contract_details')</h3>
                                        <section>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="contract_apt">@lang('global.contract_number')</label>
                                                        <input type="text" class="form-control" id="contract_apt"
                                                            name="contract_apt" value="{{ $b->contract_apt }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="contract_date">@lang('global.contract_date')</label>
                                                        <input class="form-control" type="datetime-local"
                                                            id="contract_date" name="contract_date"
                                                            value="{{ $b->contract_date }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="branch_kubmetr">@lang('global.object_amount')</label>
                                                        <input type="text" class="form-control" id="branch_kubmetr"
                                                            name="branch_kubmetr" value="{{ $b->branch_kubmetr }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="minimum_wage">@lang('global.basic_calculation_amount')</label>
                                                        <input type="text" class="form-control" id="minimum_wage"
                                                            name="minimum_wage"
                                                            value="{{ $b->company->client->products[0]->minimum_wage }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="generate_price">@lang('global.total_amount')</label>
                                                        <input type="text" class="form-control" id="generate_price"
                                                            name="generate_price" value="{{ $b->generate_price }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="payment_type">@lang('global.payment_methods')</label>
                                                        <select class="form-select" id="payment_type"
                                                            name="payment_type">
                                                            <option value="pay_full"
                                                                {{ $b->payment_type == 'pay_full' ? 'selected' : '' }}>
                                                                @lang('global.full_payment')</option>
                                                            <option value="pay_bolib"
                                                                {{ $b->payment_type == 'pay_bolib' ? 'selected' : '' }}>
                                                                @lang('global.installment_payment')</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="percentage_input">@lang('global.installment_percentage')</label>
                                                        <input type="text" class="form-control" id="percentage_input"
                                                            name="percentage_input" value="{{ $b->percentage_input }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="installment_quarterly">@lang('global.installment_quarterly')</label>
                                                        <input type="text" class="form-control"
                                                            id="installment_quarterly" name="installment_quarterly"
                                                            value="{{ $b->installment_quarterly }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    @endforeach
                                @endforeach


                                @if ($files->isNotEmpty())
                                <h4>@lang('global.downloadFile')</h4>
                                <div class="col-12 col-lg-3 mb-2">
                                    <!-- Allow users to upload additional files -->
                                    <input type="file" name="document[]" multiple>
                                    @if ($errors->has('document'))
                                        <span class="error invalid-feedback">{{ $errors->first('document') }}</span>
                                    @endif
                                </div>
                                <!-- Display existing files -->
                                <div class="my-2">
                                    @foreach ($files as $file)
                                        <div class="my-2">
                                            <a target="_blank" class="py-2 my-2" href="{{ asset($file->path) }}">Link</a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No files uploaded for this product.</p>
                            @endif

                            </div>
                        </section>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">@lang('global.update')</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
