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
                    <form action="{{ route('productUpdate', ['id' => $product->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                    
                        <!-- Shartnoma Rekvizitlari -->
                        <h3>Shartnoma Rekvizitlari</h3>
                        <section>
                            <!-- Contract Details -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="contract_apt">APT Raqami</label>
                                        <input type="text" class="form-control" id="contract_apt" name="contract_apt" value="{{ $product->contract_apt }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="contract_date">Sanasi</label>
                                        <input class="form-control" type="datetime-local" id="contract_date" name="contract_date" value="{{ $product->contract_date }}">
                                    </div>
                                </div>
                            </div>
                        </section>
                    
                        <!-- Shaxsiy Malumotlar -->
                        <h3>Shaxsiy Malumotlar</h3>
                        <section>
                            <!-- Client Details -->
                            <div class="row">
                                <!-- Mijoz Turi -->
                                <div class="col-12 col-lg-12 mb-2">
                                    <label for="mijoz_turi">Mijoz Turi</label>
                                    <select class="form-control" name="mijoz_turi" id="mijoz_turi">
                                        <option value="fizik" {{ $product->client->mijoz_turi == 'fizik' ? 'selected' : '' }}>Fizik</option>
                                        <option value="yuridik" {{ $product->client->mijoz_turi == 'yuridik' ? 'selected' : '' }}>Yuridik</option>
                                    </select>
                                </div>
                                <!-- Other Client Details -->
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="first_name">Ismi</label>
                                    <input class="form-control" type="text" id="first_name" name="first_name" value="{{ $product->client->first_name }}">
                                </div>
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="last_name">Familiyasi</label>
                                    <input class="form-control" type="text" id="last_name" name="last_name" value="{{ $product->client->last_name }}">
                                </div>
                                <div class="col-12 col-lg-4 mb-2">
                                    <label for="father_name">Otasi</label>
                                    <input class="form-control" type="text" id="father_name" name="father_name" value="{{ $product->client->father_name }}">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="passport_serial">Pasport Seriya</label>
                                    <input class="form-control" type="text" id="passport_serial" name="passport_serial" value="{{ $product->client->passport_serial }}">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="passport_pinfl">Pasport PINFL</label>
                                    <input class="form-control" type="text" id="passport_pinfl" name="passport_pinfl" value="{{ $product->client->passport_pinfl }}">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="yuridik_address">Yuridik Manzil</label>
                                    <input class="form-control" type="text" id="yuridik_address" name="yuridik_address" value="{{ $product->client->yuridik_address }}">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="yuridik_rekvizid">Yuridik Rekvizitlar</label>
                                    <input class="form-control" type="text" id="yuridik_rekvizid" name="yuridik_rekvizid" value="{{ $product->client->yuridik_rekvizid }}">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="contact">Telefon raqami</label>
                                    <input class="form-control" type="text" id="contact" name="contact" value="{{ $product->client->contact }}">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="jamgarma_rekvizitlari">Jamg'arma rekvizitlari</label>
                                    <input class="form-control" type="text" id="jamgarma_rekvizitlari" name="jamgarma_rekvizitlari" value="{{ $product->client->jamgarma_rekvizitlari }}">
                                </div>
                            </div>
                        </section>
                    
                        <!-- Obyekt -->
                        <h3>Obyekt</h3>
                        <section>
                            <!-- Company Details -->
                            <div class="row">
                                @foreach ($product->client->companies as $comp)
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="company_type">Loyiha Tur</label>
                                        <input type="text" class="form-control" id="company_type" name="company_type" value="{{ $comp->company_type }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="company_location">Loyiha Manzil</label>
                                        <input type="text" class="form-control" id="company_location" name="company_location" value="{{ $comp->company_location }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="company_name">Loyiha Nomi</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $comp->company_name }}">
                                    </div>
                                </div>

                                @foreach($comp->branches as $b)

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="branch_kubmetr">Obyekt bo'yicha tolanadigan yeg'im miqdori</label>
                                        <input type="text" class="form-control" id="branch_kubmetr" name="branch_kubmetr" value="{{ $b->branch_kubmetr }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="minimum_wage">Bazaviy xisoblash miqdori</label>
                                        <input type="text" class="form-control" id="minimum_wage" name="minimum_wage" value="{{ $b->minimum_wage }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="generate_price">Jami to'lanishi kerak bo'gan miqdor</label>
                                        <input type="text" class="form-control" id="generate_price" name="generate_price" value="{{ $b->generate_price }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="payment_type">To'lash turlari</label>
                                        <select class="form-select" id="payment_type" name="payment_type">
                                            <option value="pay_full" {{ $b->payment_type == 'pay_full' ? 'selected' : '' }}>To'liq xajimda to'lash</option>
                                            <option value="pay_bolib" {{ $b->payment_type == 'pay_bolib' ? 'selected' : '' }}>Bo'lib to'lash</option>
                                            <option value="pay_kvartalniy" {{ $b->payment_type == 'pay_kvartalniy' ? 'selected' : '' }}>Kvartalniy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="installment_percentage">Bo'lib to'lash foizi oldindan</label>
                                        <input type="text" class="form-control" id="installment_percentage" name="installment_percentage" value="{{ $b->installment_percentage }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="installment_quarterly">Bo'lib to'lash kvartalniy</label>
                                        <input type="text" class="form-control" id="installment_quarterly" name="installment_quarterly" value="{{ $b->installment_quarterly }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach

                                @endforeach
                             
                              
                        </section>
                    
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">O'zgartirish</button>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection
