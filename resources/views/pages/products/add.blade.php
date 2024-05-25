@extends('layouts.admin')

@section('content')
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

                    <div id="basic-example">
                        <!-- Seller Details -->
                        <h3>Shartnoma Rekvizitlari</h3>
                        <section>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">APT Raqami</label>
                                            <input type="text" class="form-control" id="basicpill-firstname-input"
                                                placeholder="APT">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-lastname-input">Sanasi</label>

                                            <input class="form-control" type="datetime-local" id="example-datetime-local-input">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </section>

                        <!-- Company Document -->
                        <h3>Shaxsiy Malumotlar</h3>
                        <section>
                            <form>
                                @csrf
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
                                        <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" placeholder="@lang('cruds.client.fields.first_name')" value="{{ old('first_name') }}">
                                        @if ($errors->has('first_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
    
                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="last_name" class="col-md-4 col-form-label">@lang('cruds.client.fields.last_name')</label>
                                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" placeholder="@lang('cruds.client.fields.last_name')" value="{{ old('last_name') }}">
                                        @if ($errors->has('last_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
    
                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="father_name" class="col-md-4 col-form-label">@lang('cruds.client.fields.father_name')</label>
                                        <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text" name="father_name" id="father_name" placeholder="@lang('cruds.client.fields.father_name')" value="{{ old('father_name') }}">
                                        @if ($errors->has('father_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('father_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="passport_serial" class="col-md-4 col-form-label">@lang('cruds.client.fields.passport_serial')</label>
                                        <input class="form-control {{ $errors->has('passport_serial') ? 'is-invalid' : '' }}" type="text" name="passport_serial" id="passport_serial" placeholder="@lang('cruds.client.fields.passport_serial')" value="{{ old('passport_serial') }}">
                                        @if ($errors->has('passport_serial'))
                                            <span class="error invalid-feedback">{{ $errors->first('passport_serial') }}</span>
                                        @endif
                                    </div>
    
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="passport_pinfl" class="col-md-4 col-form-label">@lang('cruds.client.fields.passport_pinfl')</label>
                                        <input class="form-control {{ $errors->has('passport_pinfl') ? 'is-invalid' : '' }}" type="text" name="passport_pinfl" id="passport_pinfl" placeholder="@lang('cruds.client.fields.passport_pinfl')" value="{{ old('passport_pinfl') }}">
                                        @if ($errors->has('passport_pinfl'))
                                            <span class="error invalid-feedback">{{ $errors->first('passport_pinfl') }}</span>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="yuridik_address" class="col-md-4 col-form-label">@lang('cruds.client.fields.yuridik_address')</label>
                                        <input class="form-control {{ $errors->has('yuridik_address') ? 'is-invalid' : '' }}" type="text" name="yuridik_address" id="yuridik_address" placeholder="@lang('cruds.client.fields.yuridik_address')" value="{{ old('yuridik_address') }}">
                                        @if ($errors->has('yuridik_address'))
                                            <span class="error invalid-feedback">{{ $errors->first('yuridik_address') }}</span>
                                        @endif
                                    </div>
    
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="yuridik_rekvizid" class="col-md-4 col-form-label">@lang('cruds.client.fields.yuridik_rekvizid')</label>
                                        <input class="form-control {{ $errors->has('yuridik_rekvizid') ? 'is-invalid' : '' }}" type="text" name="yuridik_rekvizid" id="yuridik_rekvizid" placeholder="@lang('cruds.client.fields.yuridik_rekvizid')" value="{{ old('yuridik_rekvizid') }}">
                                        @if ($errors->has('yuridik_rekvizid'))
                                            <span class="error invalid-feedback">{{ $errors->first('yuridik_rekvizid') }}</span>
                                        @endif
                                    </div>
    
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="name" class="col-md-4 col-form-label">@lang('cruds.client.fields.contact')</label>
                                        <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" placeholder="@lang('cruds.client.fields.contact')" value="{{ old('contact') }}">
                                        @if ($errors->has('contact'))
                                            <span class="error invalid-feedback">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="name" class="col-md-4 col-form-label">Jarima Rekviztlari</label>
                                        <input class="form-control {{ $errors->has('jarima_rekvizitlari') ? 'is-invalid' : '' }}" type="text" name="jarima_rekvizitlari" id="jarima_rekvizitlari" placeholder="Jarima Rekvizitlari" value="{{ old('jarima_rekvizitlari') }}">
                                        @if ($errors->has('jarima_rekvizitlari'))
                                            <span class="error invalid-feedback">{{ $errors->first('jarima_rekvizitlari') }}</span>
                                        @endif
                                    </div>
                                </div>
        
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var mijozTuri = document.getElementById('mijoz_turi');
                                        var additionalFieldsFizik = document.getElementById('additionalFieldsFizik');
                                        var additionalFieldsYuridik = document.getElementById('additionalFieldsYuridik');
        
                                        function toggleFields() {
                                            if (mijozTuri.value === 'fizik') {
                                                // Show fizik fields
                                                additionalFieldsFizik.style.display = 'block';
                                                additionalFieldsFizik.querySelectorAll('input').forEach(function(input) {
                                                    input.required = true;
                                                });
                                                
                                                // Hide yuridik fields
                                                additionalFieldsYuridik.style.display = 'none';
                                                additionalFieldsYuridik.querySelectorAll('input').forEach(function(input) {
                                                    input.required = false;
                                                });
                                            } else {
                                                // Show yuridik fields
                                                additionalFieldsYuridik.style.display = 'block';
                                                additionalFieldsYuridik.querySelectorAll('input').forEach(function(input) {
                                                    input.required = true;
                                                });
                                                
                                                // Hide fizik fields
                                                additionalFieldsFizik.style.display = 'none';
                                                additionalFieldsFizik.querySelectorAll('input').forEach(function(input) {
                                                    input.required = false;
                                                });
                                            }
                                        }
        
                                        // Trigger the function on page load and on change
                                        toggleFields();
                                        mijozTuri.addEventListener('change', toggleFields);
                                    });
                                </script>
                                
                            </form>
                        </section>
                        
                        

                        <!-- Bank Details -->
                        <h3>Obyekt</h3>
                        <section>
                            <div>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-namecard-input">Loyixa Turi</label>
                                                <input type="text" class="form-control" id="basicpill-namecard-input"
                                                    placeholder="Loyixa Turi">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-namecard-input">Loyixa Manzili</label>
                                                <input type="text" class="form-control" id="basicpill-namecard-input"
                                                    placeholder="Loyixa Manzili">
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Credit Card Type</label>
                                                <select class="form-select">
                                                    <option selected>Select Card Type</option>
                                                    <option value="AE">American Express</option>
                                                    <option value="VI">Visa</option>
                                                    <option value="MC">MasterCard</option>
                                                    <option value="DI">Discover</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="basicpill-cardno-input">Obyekt bo'yicha tolanadigan yeg'im miqdori</label>
                                                <input type="text" class="form-control" id="basicpill-cardno-input"
                                                    placeholder="Metr Kub">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="basicpill-card-verification-input">Bazaviy xisoblash miqdori</label>
                                                <input type="text" class="form-control"
                                                    id="basicpill-card-verification-input"
                                                    placeholder="340 min">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="basicpill-card-verification-input">Jami to'lanishi kerak bo'gan miqdor</label>
                                                <input type="text" class="form-control"
                                                    id="basicpill-card-verification-input"
                                                    placeholder="------------">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                          <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>To'lash turlari</label>
                                                <select class="form-select">
                                                    <option selected>To'liq xajimda to'lash </option>
                                                    <option value="AE">Bo'lib to'lash</option>
                                                    <option value="VI">Kvartalniy</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-expiration-input">Yegib to'lash usuli</label>
                                                <input type="text" class="form-control"
                                                    id="basicpill-expiration-input" placeholder="Yegib to'lash usuli">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-expiration-input">Bo'lib to'lash foizi oldindan </label>
                                                <input type="text" class="form-control"
                                                    id="basicpill-expiration-input" placeholder="20% ">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-expiration-input">Bo'lib to'lash kvartalniy</label>
                                                <input type="text" class="form-control"
                                                    id="basicpill-expiration-input" placeholder="Bo'lib to'lash kvartalniy ">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </section>

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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                 
                    </div>


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

@endsection
