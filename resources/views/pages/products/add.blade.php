@extends('layouts.admin')

@section('content')
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
                        <li class="breadcrumb-item active">@lang('global.add')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('productCreate') }}" method="post">
                        @csrf

                        <div id="basic-example">
                            <h3>Shaxsiy Malumotlar</h3>
                            <section>

                                <div class="row">
                                    <div class="col-12 col-lg-12 mb-2">
                                        <label for="mijoz_turi" class="col-md-4 col-form-label">@lang('cruds.client.fields.mijoz_turi')</label>
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
                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="name" class="col-md-4 col-form-label">@lang('cruds.client.fields.name')</label>
                                        <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                            type="text" name="first_name" id="first_name" placeholder="@lang('cruds.client.fields.first_name')"
                                            value="{{ old('first_name') }}">
                                        @if ($errors->has('first_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="last_name" class="col-md-4 col-form-label">@lang('cruds.client.fields.last_name')</label>
                                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                            type="text" name="last_name" id="last_name" placeholder="@lang('cruds.client.fields.last_name')"
                                            value="{{ old('last_name') }}">
                                        @if ($errors->has('last_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="father_name" class="col-md-4 col-form-label">@lang('cruds.client.fields.father_name')</label>
                                        <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                                            type="text" name="father_name" id="father_name"
                                            placeholder="@lang('cruds.client.fields.father_name')" value="{{ old('father_name') }}">
                                        @if ($errors->has('father_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('father_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="passport_serial"
                                            class="col-md-4 col-form-label">@lang('cruds.client.fields.passport_serial')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_serial') ? 'is-invalid' : '' }}"
                                            type="text" name="passport_serial" id="passport_serial"
                                            placeholder="@lang('cruds.client.fields.passport_serial')" value="{{ old('passport_serial') }}">
                                        @if ($errors->has('passport_serial'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_serial') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="passport_pinfl"
                                            class="col-md-4 col-form-label">@lang('cruds.client.fields.passport_pinfl')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_pinfl') ? 'is-invalid' : '' }}"
                                            type="text" name="passport_pinfl" id="passport_pinfl"
                                            placeholder="@lang('cruds.client.fields.passport_pinfl')" value="{{ old('passport_pinfl') }}">
                                        @if ($errors->has('passport_pinfl'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_pinfl') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="yuridik_address"
                                            class="col-md-4 col-form-label">@lang('cruds.client.fields.yuridik_address')</label>
                                        <input
                                            class="form-control {{ $errors->has('yuridik_address') ? 'is-invalid' : '' }}"
                                            type="text" name="yuridik_address" id="yuridik_address"
                                            placeholder="@lang('cruds.client.fields.yuridik_address')" value="{{ old('yuridik_address') }}">
                                        @if ($errors->has('yuridik_address'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('yuridik_address') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="yuridik_rekvizid"
                                            class="col-md-4 col-form-label">@lang('cruds.client.fields.yuridik_rekvizid')</label>
                                        <input
                                            class="form-control {{ $errors->has('yuridik_rekvizid') ? 'is-invalid' : '' }}"
                                            type="text" name="yuridik_rekvizid" id="yuridik_rekvizid"
                                            placeholder="@lang('cruds.client.fields.yuridik_rekvizid')" value="{{ old('yuridik_rekvizid') }}">
                                        @if ($errors->has('yuridik_rekvizid'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('yuridik_rekvizid') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="name" class="col-md-4 col-form-label">@lang('cruds.client.fields.contact')</label>
                                        <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}"
                                            type="text" name="contact" id="contact"
                                            placeholder="@lang('cruds.client.fields.contact')" value="{{ old('contact') }}">
                                        @if ($errors->has('contact'))
                                            <span class="error invalid-feedback">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="name" class="col-md-4 col-form-label">Jamg'arma Rekviztlari</label>
                                        <input
                                            class="form-control {{ $errors->has('jamgarma_rekvizitlari') ? 'is-invalid' : '' }}"
                                            type="text" name="jamgarma_rekvizitlari" id="jamgarma_rekvizitlari"
                                            placeholder="Jamgarma Rekvizitlari" value="{{ old('jamgarma_rekvizitlari') }}">
                                        @if ($errors->has('jamgarma_rekvizitlari'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('jamgarma_rekvizitlari') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </section>

                            <!-- Bank Details -->
                            <h3>Obyekt</h3>
                            <section>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Accordion Item #0
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body text-muted">
                                                <main class="main_of_objects">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="contract_apt">APT Raqami</label>
                                                                <input type="text" class="form-control" name="accordions[0][contract_apt]" placeholder="APT">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="contract_date">Sanasi</label>
                                                                <input class="form-control" type="datetime-local" name="accordions[0][contract_date]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="company_type">Loyixa Turi</label>
                                                                <input type="text" class="form-control" name="accordions[0][company_type]" placeholder="Loyixa Turi">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="company_location">Loyixa Manzili</label>
                                                                <input type="text" class="form-control" name="accordions[0][company_location]" placeholder="Loyixa Manzili">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="company_name">Loyixa Nomi</label>
                                                                <input type="text" class="form-control" name="accordions[0][company_name]" placeholder="Loyixa Nomi">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="company_kubmetr">Obyekt bo'yicha tolanadigan yeg'im miqdori</label>
                                                                <input type="text" class="form-control" name="accordions[0][company_kubmetr]" placeholder="Metr Kub">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="minimum_wage">Bazaviy xisoblash miqdori</label>
                                                                <input type="text" class="form-control" name="accordions[0][minimum_wage]" placeholder="340 min" value="340">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="generate_price">Jami to'lanishi kerak bo'gan miqdor</label>
                                                                <input type="text" class="form-control" name="accordions[0][generate_price]" placeholder="------------" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </main>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="addAccordion" class="btn btn-primary mt-3">Add Accordion</div>
                            </section>
                            
                            <script>
                                $(document).ready(function () {
                                    let accordionCount = 1;
                                    $('#addAccordion').on('click', function () {
                                        let accordion = $('.accordion-item').first().clone();
                                        let newId = 'flush-collapse' + accordionCount;
                                        accordion.find('.accordion-collapse').attr('id', newId);
                                        accordion.find('.accordion-button').attr('data-bs-target', '#' + newId);
                                        accordion.find('.accordion-header').attr('id', 'flush-heading' + accordionCount);
                                        accordion.find('.accordion-button').attr('aria-controls', newId);
                                        accordion.find('.accordion-button').text('Accordion Item #' + accordionCount);
                                        
                                        accordion.find('input').each(function() {
                                            let name = $(this).attr('name');
                                            let newName = name.replace(/\[0\]/, '[' + accordionCount + ']');
                                            $(this).attr('name', newName);
                                            $(this).val('');
                                        });
                            
                                        accordion.appendTo('#accordionFlushExample');
                                        accordionCount++;
                                    });
                                });
                            </script>
                            
                            <!-- Confirm Details -->
                            <h3>Tasdiqlash</h3>
                            <section>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                            </div>
                                            <div>
                                                <h5>Tasdiqlash</h5>
                                                <p class="text-muted">Barcha kiritgan malumotlaringiz to'grimi ? </p>

                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

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
