@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">@lang('cruds.branches.title') Edit</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('clientIndex') }}"
                                style="color: #007bff;">@lang('cruds.branches.title') Edit</a></li>
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
                    <form action="{{ route('clientUpdate', ['id' => $client->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div id="vertical-example" class="vertical-wizard wizard clearfix vertical">
                            <h3>@lang('global.personal_informations')</h3>
                            <section>

                                <div class="row">
                                    <div class="col-12 col-lg-12 mb-2">
                                        <label for="mijoz_turi" class="col-md-6 col-form-label">@lang('cruds.client.fields.mijoz_turi')</label>
                                        <select class="form-control" name="mijoz_turi" id="mijoz_turi">
                                            <option value="fizik"
                                                {{ old('mijoz_turi', $client->mijoz_turi) == 'fizik' ? 'selected' : '' }}>
                                                @lang('cruds.client.fields.mijoz_turi_fizik')</option>
                                            <option value="yuridik"
                                                {{ old('mijoz_turi', $client->mijoz_turi) == 'yuridik' ? 'selected' : '' }}>
                                                @lang('cruds.client.fields.mijoz_turi_yuridik')</option>
                                        </select>
                                        @if ($errors->has('mijoz_turi'))
                                            <span class="error invalid-feedback">{{ $errors->first('mijoz_turi') }}</span>
                                        @endif
                                    </div>
                                </div>
                              

                                <div class="row" id="make_show" style="display: none;">

                                    {{-- <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="company_location">@lang('global.loyiha_manzili')</label>
                                            <input type="text" class="form-control" name="company_location"
                                                value="{{ old('company_location', $client->company_location) }}"
                                                placeholder="@lang('global.loyiha_manzili')">
                                        </div>
                                    </div> --}}
                                    <div class="col-12 col-lg-3 mb-2">
                                        <div class="mb-3">
                                            <label for="company_name">@lang('global.company_name')</label>
                                            <input type="text" class="form-control" name="company_name"
                                                value="{{ old('company_name', $client->company_name) }}"
                                                placeholder="@lang('global.loyiha_nomi')">
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="raxbar" class="col-md-6 col-form-label">@lang('cruds.company.fields.raxbar') -
                                            @lang('global.client_name')</label>
                                        <input class="form-control {{ $errors->has('raxbar') ? 'is-invalid' : '' }}"
                                            type="text" name="raxbar" id="raxbar" placeholder="@lang('cruds.company.fields.raxbar')"
                                            value="{{ old('raxbar', $client->raxbar) }}">
                                        @if ($errors->has('raxbar'))
                                            <span class="error invalid-feedback">{{ $errors->first('raxbar') }}</span>
                                        @endif
                                    </div>


                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="stir" class="col-md-6 col-form-label">@lang('cruds.company.fields.stir')</label>
                                        <input class="form-control {{ $errors->has('stir') ? 'is-invalid' : '' }}"
                                            type="text" name="stir" id="stir" placeholder="@lang('cruds.company.fields.stir')"
                                            value="{{ old('stir', $client->stir) }}" maxlength="9">
                                        @if ($errors->has('stir'))
                                            <span class="error invalid-feedback">{{ $errors->first('stir') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="oked" class="col-md-6 col-form-label">@lang('cruds.company.fields.oked')</label>
                                        <input class="form-control {{ $errors->has('oked') ? 'is-invalid' : '' }}"
                                            type="text" name="oked" id="oked" placeholder="@lang('cruds.company.fields.oked')"
                                            value="{{ old('oked', $client->oked) }}" maxlength="5">
                                        @if ($errors->has('oked'))
                                            <span class="error invalid-feedback">{{ $errors->first('oked') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="bank_service" class="col-md-6 col-form-label">@lang('cruds.company.fields.bank_service')</label>
                                        <input class="form-control {{ $errors->has('bank_service') ? 'is-invalid' : '' }}"
                                            type="text" name="bank_service" id="bank_service"
                                            placeholder="@lang('cruds.company.fields.bank_service')"
                                            value="{{ old('bank_service', $client->bank_service) }}">
                                        @if ($errors->has('bank_service'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('bank_service') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="bank_code" class="col-md-6 col-form-label">@lang('cruds.company.fields.bank_code')</label>
                                        <input class="form-control {{ $errors->has('bank_code') ? 'is-invalid' : '' }}"
                                            type="text" name="bank_code" max="5" id="bank_code"
                                            placeholder="@lang('cruds.company.fields.bank_code')"
                                            value="{{ old('bank_code', $client->bank_code) }}" maxlength="5"
                                            name="bank_code" id="bank_code">

                                        @if ($errors->has('bank_code'))
                                            <span class="error invalid-feedback">{{ $errors->first('bank_code') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="bank_account"
                                            class="col-md-6 col-form-label">@lang('cruds.company.fields.bank_account')</label>
                                        <input class="form-control {{ $errors->has('bank_account') ? 'is-invalid' : '' }}"
                                            type="text" name="bank_account" max="5" id="bank_account"
                                            placeholder="@lang('cruds.company.fields.bank_account')"
                                            value="{{ old('bank_account', $client->bank_account) }}" maxlength="20"
                                            name="bank_account" id="alloptions">

                                        @if ($errors->has('bank_account'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('bank_account') }}</span>
                                        @endif
                                    </div>


                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="yuridik_address"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.yuridik_address')</label>
                                        <input
                                            class="form-control {{ $errors->has('yuridik_address') ? 'is-invalid' : '' }}"
                                            type="text" name="yuridik_address" id="yuridik_address"
                                            placeholder="@lang('cruds.client.fields.yuridik_address')"
                                            value="{{ old('yuridik_address', $client->yuridik_address) }}">
                                        @if ($errors->has('yuridik_address'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('yuridik_address') }}</span>
                                        @endif
                                    </div>

                                    {{-- <div class="col-12 col-lg-3 mb-2">
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
                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="last_name" class="col-md-4 col-form-label">@lang('cruds.client.fields.last_name')</label>
                                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                            type="text" name="last_name" id="last_name"
                                            placeholder="@lang('cruds.client.fields.last_name')"
                                            value="{{ old('last_name', $client->last_name) }}">
                                        @if ($errors->has('last_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="name" class="col-md-4 col-form-label">@lang('cruds.client.fields.name')</label>
                                        <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                            type="text" name="first_name" id="first_name"
                                            placeholder="@lang('cruds.client.fields.first_name')"
                                            value="{{ old('first_name', $client->first_name) }}">
                                        @if ($errors->has('first_name'))
                                            <span class="error invalid-feedback">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="father_name"
                                            class="col-md-4 col-form-label">@lang('cruds.client.fields.father_name')</label>
                                        <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                                            type="text" name="father_name" id="father_name"
                                            placeholder="@lang('cruds.client.fields.father_name')"
                                            value="{{ old('father_name', $client->father_name) }}">
                                        @if ($errors->has('father_name'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('father_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="contact" class="col-md-4 col-form-label">@lang('cruds.client.fields.contact')</label>
                                        <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}"
                                            type="text" name="contact" id="contact"
                                            placeholder="@lang('cruds.client.fields.contact')"
                                            value="{{ old('contact', $client->contact) }}">
                                        @if ($errors->has('contact'))
                                            <span class="error invalid-feedback">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row" id="make_hide">

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="passport_serial"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_serial')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_serial') ? 'is-invalid' : '' }}"
                                            type="text" name="passport_serial" id="passport_serial"
                                            placeholder="@lang('cruds.client.fields.passport_serial')"
                                            value="{{ old('passport_serial', $client->passport_serial) }}" maxlength="10">
                                        @if ($errors->has('passport_serial'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_serial') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="passport_pinfl"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.passport_pinfl')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_pinfl') ? 'is-invalid' : '' }}"
                                            type="text" name="passport_pinfl" id="passport_pinfl"
                                            placeholder="@lang('cruds.client.fields.passport_pinfl')"
                                            value="{{ old('passport_pinfl', $client->passport_pinfl) }}" maxlength="14">
                                        @if ($errors->has('passport_pinfl'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_pinfl') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="passport_date"
                                            class="col-md-4 col-form-label">@lang('cruds.client.fields.passport_date')</label>
                                        <input
                                            class="form-control {{ $errors->has('passport_date') ? 'is-invalid' : '' }}"
                                            type="date" name="passport_date" id="passport_date"
                                            placeholder="@lang('cruds.client.fields.passport_date')"
                                            value="{{ old('passport_date', $client->passport_date) }}">
                                        @if ($errors->has('passport_date'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('passport_date') }}</span>
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
                                        <label for="home_address"
                                            class="col-md-6 col-form-label">@lang('global.home_address')</label>
                                        <input
                                            class="form-control {{ $errors->has('home_address') ? 'is-invalid' : '' }}"
                                            type="text" name="home_address" id="home_address"
                                            placeholder="@lang('global.home_address')"
                                            value="{{ old('home_address', $client->home_address) }}">
                                        @if ($errors->has('home_address'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('home_address') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="row" style="align-items: center ">
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label for="client_description"
                                            class="col-md-6 col-form-label">@lang('cruds.client.fields.client_description')</label>
                                        <textarea id="textarea" name="client_description"
                                            class="form-control {{ $errors->has('client_description') ? 'is-invalid' : '' }}" maxlength="225" rows="3"
                                            placeholder="This textarea has a limit of 225 chars.">{{ old('client_description', $client->client_description) }}</textarea>
                                        @if ($errors->has('client_description'))
                                            <span
                                                class="error invalid-feedback">{{ $errors->first('client_description') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="file" class="col-md-4 col-form-label">File document</label>
                                        <input type="file" name="document[]" multiple>
                                        @if ($errors->has('document'))
                                            <span class="error invalid-feedback">{{ $errors->first('document') }}</span>
                                        @endif
                                    </div>
                                    <ul>
                                        @foreach ($files as $file)
                                            <div class="py-1">
                                                <a target="_blank" class="py-2 my-2"
                                                    href="{{ asset($file->path) }}">{{ $file->path }}</a>
                                                @can('client.delete')
                                                    Delete
                                                    <input type="checkbox" name="delete_files[]"
                                                        value="{{ $file->id }}">
                                                @endcan
                                            </div>
                                        @endforeach
                                    </ul>

                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="is_passport_id" class="col-md-6 col-form-label">Is passport
                                            ID?</label>
                                        <input type="checkbox" name="passport_type" id="is_passport_id" value="1">
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

                            </section>


                      


                            <h3>@lang('global.object')</h3>
                            <section>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    @foreach ($client->branches as $branchIndex => $b)

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading{{ $branchIndex }}">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapse{{ $branchIndex }}"
                                                    aria-expanded="false"
                                                    aria-controls="flush-collapse{{ $branchIndex }}">
                                                    Accordion Item #{{ $branchIndex }}
                                                </button>
                                            </h2>
                                            <input type="hidden" name="accordions[{{ $branchIndex }}][id]" value="{{ $b->id }}">

                                            <div id="flush-collapse{{ $branchIndex }}"
                                                class="accordion-collapse collapse show"
                                                aria-labelledby="flush-heading{{ $branchIndex }}"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body text-muted">
                                                    <main class="main_of_objects">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="contract_apt">@lang('global.ruxsatnoma_raqami')</label>
                                                                    <input type="text" class="form-control"
                                                                        name="accordions[{{ $branchIndex }}][contract_apt]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.contract_apt', $b->contract_apt) }}"

                                                                        placeholder="@lang('global.ruxsatnoma_raqami')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="contract_date">@lang('global.sanasi')</label>
                                                                    <input class="form-control" type="date"
                                                                        name="accordions[{{ $branchIndex }}][contract_date]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.contract_date', $b->contract_date) }}">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="notification_num">@lang('cruds.branches.fields.notification_num')</label>
                                                                    <input type="text" class="form-control"
                                                                        name="accordions[{{ $branchIndex }}][notification_num]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.notification_num', $b->notification_num) }}"
                                                                        
                                                                        placeholder="@lang('cruds.branches.fields.notification_num')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="notification_date">@lang('cruds.branches.fields.notification_date')</label>
                                                                    <input type="date" class="form-control"
                                                                        name="accordions[{{ $branchIndex }}][notification_date]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.notification_date', $b->notification_date) }}"
                                                                        
                                                                        placeholder="@lang('cruds.branches.fields.notification_date')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="insurance_policy">@lang('cruds.branches.fields.insurance_policy')</label>
                                                                    <input type="text" class="form-control"
                                                                        name="accordions[{{ $branchIndex }}][insurance_policy]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.insurance_policy', $b->insurance_policy) }}"
                                                                        
                                                                        placeholder="@lang('cruds.branches.fields.insurance_policy')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label for="bank_guarantee">@lang('cruds.branches.fields.bank_guarantee')</label>
                                                                    <input type="text" class="form-control"
                                                                        name="accordions[{{ $branchIndex }}][bank_guarantee]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.bank_guarantee', $b->bank_guarantee) }}"
                                                                        
                                                                        placeholder="@lang('cruds.branches.fields.bank_guarantee')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="application_number">@lang('cruds.branches.fields.application_number')</label>
                                                                    <input type="text" class="form-control"
                                                                        name="accordions[{{ $branchIndex }}][application_number]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.application_number', $b->application_number) }}"
                                                                        
                                                                        placeholder="@lang('cruds.branches.fields.application_number')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    
                                                                    <label for="payedSum_{{ $branchIndex }}">@lang('cruds.branches.fields.payed_sum')</label>
                                                                    <input type="text" class="form-control payedSum"
                                                                        id="payedSum_{{ $branchIndex }}"
                                                                        name="accordions[{{ $branchIndex }}][payed_sum]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.payed_sum', $b->payed_sum) }}"
                                                                        placeholder="@lang('cruds.branches.fields.payed_sum')">
                                                                    
                                                                    
                                                                        {{-- <script>
                                                                                function formatNumberWithSpaces(number) {
                                                                                    // Ensure the number is a string
                                                                                    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                                                                                }
                                                                        
                                                                                function unformatNumberWithSpaces(number) {
                                                                                    // Remove all spaces
                                                                                    return number.replace(/\s/g, '');
                                                                                }
                                                                        
                                                                                document.querySelectorAll('.payedSum').forEach(function(input) {
                                                                                    input.addEventListener('blur', function () {
                                                                                        var value = unformatNumberWithSpaces(input.value);
                                                                                        if (!isNaN(value) && value.trim() !== '') {
                                                                                            input.value = formatNumberWithSpaces(value);
                                                                                        }
                                                                                    });
                                                                        
                                                                                    // Optionally format the value on page load if there's an initial value
                                                                                    input.value = formatNumberWithSpaces(input.value);
                                                                                });
                                                                            
                                                                        </script>
                                                                         --}}
                                                                        
                                                                    
                                                                        
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="payed_date">@lang('cruds.branches.fields.payed_date')</label>
                                                                    <input type="date" class="form-control"
                                                                        name="accordions[{{ $branchIndex }}][payed_date]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.payed_date', $b->payed_date) }}"
                                                                        placeholder="@lang('cruds.branches.fields.payed_date')">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                          

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="branch_type">@lang('global.loyiha_turi')</label>
                                                                    <input type="text" class="form-control" name="accordions[{{ $branchIndex }}][branch_type]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.branch_type', $b->branch_type) }}"

                                                                        placeholder="@lang('global.loyiha_turi')">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="branch_location">@lang('cruds.company.fields.branch_location')</label>
                                                                    <input type="text" class="form-control" name="accordions[{{ $branchIndex }}][branch_location]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.branch_location', $b->branch_location) }}"

                                                                        placeholder="@lang('cruds.company.fields.branch_location')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="inner-repeater mb-4">
                                                                    <div data-repeater-list="inner-group" class="inner mb-3">
                                                                        <label for="basicpill-cardno-input">@lang('global.obyekt_boyicha_tolanishi_lozim')</label>
                                                                        <input type="number"
                                                                               class="form-control branch_kubmetr"
                                                                               step="0.00001"
                                                                               placeholder="( m³ )"
                                                                               value="{{ old('accordions.' . $branchIndex . '.branch_kubmetr', $b->branch_kubmetr) }}"
                                                                               name="accordions[{{ $branchIndex }}][branch_kubmetr]"
                                                                               onchange="displayFiveDigitsAfterDecimal(this)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <script>
                                                                function displayFiveDigitsAfterDecimal(inputField) {
                                                                    var value = parseFloat(inputField.value);
                                                                    var roundedValue = value.toFixed(5);
                                                                    inputField.value = roundedValue;
                                                                }
                                                            </script>
                                                            

                                                            <div class="col-lg-4">
                                                                <div class="inner-repeater mb-4">
                                                                    <div data-repeater-list="inner-group"
                                                                        class="inner mb-3">
                                                                        <label
                                                                            for="basicpill-cardno-input">@lang('global.loyiha_nomi')</label>
                                                                        <input type="text"
                                                                            class="form-control branch_name"
                                                                            placeholder="@lang('global.loyiha_nomi')"
                                                                            value="{{ old('accordions.' . $branchIndex . '.branch_name', $b->branch_name) }}"
                                                                            name="accordions[{{ $branchIndex }}][branch_name]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="basicpill-card-verification-input">@lang('global.bazaviy_xisoblash_miqdori')</label>
                                                                    <input type="number"
                                                                        class="form-control minimum_wage"
                                                                        placeholder="@lang('global.bazaviy_xisoblash_miqdori')" value="340000"
                                                                        name="accordions[{{ $branchIndex }}][minimum_wage]">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="basicpill-card-verification-input">@lang('global.jami_tolanishi_kerak')</label>
                                                                    <input type="text"
                                                                        class="form-control generate_price"
                                                                        name="accordions[{{ $branchIndex }}][generate_price]"
                                                                        value="{{ old('accordions.' . $branchIndex . '.generate_price', $b->generate_price) }}"
                                                                        placeholder="@lang('global.jami_tolanishi_kerak')">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>@lang('global.tolash_turlari')</label>
                                                                    <select class="form-select payment-type"
                                                                        id="payment_type"
                                                                        name="accordions[{{ $branchIndex }}][payment_type]">
                                                                        <option value="pay_full"
                                                                            {{ $b->payment_type == 'pay_full' ? 'selected' : '' }}>
                                                                            @lang('global.toliq_xajimda_tolash')</option>
                                                                        <option value="pay_bolib"
                                                                            {{ $b->payment_type == 'pay_bolib' ? 'selected' : '' }}>
                                                                            @lang('global.bolib_tolash')</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="percentage-input">@lang('global.bolib_tolash_foizi_oldindan')</label>
                                                                    <div class="input-group">
                                                                        <input type="number"
                                                                            class="form-control percentage-input"
                                                                            name="accordions[{{ $branchIndex }}][percentage_input]"
                                                                            value="{{ old('accordions.' . $branchIndex . '.percentage_input', $b->percentage_input) }}"
                                                                            min="0" max="100">
                                                                        <span class="input-group-text">%</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="quarterly-input">@lang('global.bolib_tolash_har_chorakda')</label>
                                                                    <div class="input-group">
                                                                        <input type="number"
                                                                            class="form-control quarterly-input"
                                                                            name="accordions[{{ $branchIndex }}][quarterly_input]"
                                                                            value="{{ old('accordions.' . $branchIndex . '.quarterly_input', $b->quarterly_input) }}"
                                                                            min="0">
                                                                        <span
                                                                            class="input-group-text"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                    </main>
                                                    <button type="button"
                                                        class="removeAccordion btn btn-danger mt-3">Remove</button>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button id="addAccordion" type="button" class="btn btn-primary text-light ">Add
                                    Accordion</button>
                            </section>
                            

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    let accordionCount = {{ count($client->branches) }};
                                    const addAccordionButton = $('#addAccordion');

                                    addAccordionButton.on('click', function() {
                                        console.log('Add Accordion button clicked');
                                        const accordionItem = $('.accordion-item').last(); // Select the last accordion item
                                        if (!accordionItem.length) {
                                            console.error('Accordion item template not found');
                                            return;
                                        }
                                        console.log('Found accordion item template');

                                        const newAccordion = accordionItem.clone();
                                        const newId = 'flush-collapse' + accordionCount;
                                        const newButtonId = 'flush-heading' + accordionCount;

                                        newAccordion.find('.accordion-collapse').attr('id', newId);
                                        newAccordion.find('.accordion-button').attr('data-bs-target', '#' + newId);
                                        newAccordion.find('.accordion-header').attr('id', newButtonId);
                                        newAccordion.find('.accordion-button').attr('aria-controls', newId);
                                        newAccordion.find('.accordion-button').text('Accordion Item #' + accordionCount);

                                        newAccordion.find('input, select').each(function() {
                                            let name = $(this).attr('name');
                                            if (name) {
                                                let newName = name.replace(/\[\d+\]/, '[' + accordionCount + ']');
                                                $(this).attr('name', newName);
                                                $(this).attr('id', newName + '-' + accordionCount);
                                            }
                                            $(this).val('');
                                        });

                                        $('#accordionFlushExample').append(newAccordion);
                                        console.log('Accordion item added with count:', accordionCount);
                                        accordionCount++;
                                    });

                                    $(document).on('click', '.removeAccordion', function() {
                                        console.log('Remove Accordion button clicked');
                                        $(this).closest('.accordion-item').remove();
                                    });
                                });

                                $(document).on('input change', '.branch_kubmetr, .minimum_wage, .percentage-input, .quarterly-input', function() {
                                    let parentAccordion = $(this).closest('.accordion-body');
                                    calculateGeneratePrice(parentAccordion);
                                });

                                function calculateGeneratePrice(parentAccordion) {
                                    let companyKubmetr = parseFloat(parentAccordion.find('.branch_kubmetr').val()) || 0;
                                    let minimumWage = parseFloat(parentAccordion.find('.minimum_wage').val()) || 0;
                                    let generatePrice = companyKubmetr * minimumWage;
                                    parentAccordion.find('.generate_price').val(generatePrice.toFixed(2));

                                    let percentageInput = parseFloat(parentAccordion.find('.percentage-input').val()) || 0;
                                    let quarterlyInput = parseInt(parentAccordion.find('.quarterly-input').val()) || 0;

                                    if (percentageInput > 100) percentageInput = 100;
                                    if (percentageInput < 0) percentageInput = 0;

                                    if (!isNaN(generatePrice) && !isNaN(percentageInput) && !isNaN(quarterlyInput) && quarterlyInput > 0) {
                                        let z = (generatePrice * percentageInput) / 100;
                                        let n = generatePrice - z;
                                        let y = n / quarterlyInput;
                                        parentAccordion.find('.calculated-quarterly-payment').val(y.toFixed(2));

                                        updatePaymentSchedule(parentAccordion, generatePrice);
                                        updateQuarterlyPaymentSchedule(parentAccordion, y, quarterlyInput);
                                    } else {
                                        parentAccordion.find('.calculated-quarterly-payment').val('');
                                        parentAccordion.find('.payment-schedule').html('');
                                        parentAccordion.find('.quarterly-payment-schedule').html('');
                                    }
                                }

                                function updatePaymentSchedule(parentAccordion, generatePrice) {
                                    let paymentSchedule = parentAccordion.find('.payment-schedule');
                                    paymentSchedule.html('');
                                    let percentages = [0, 10, 20, 30, 40, 50];
                                    percentages.forEach(percentage => {
                                        let z = Math.round((generatePrice * percentage) / 100); // Rounding z
                                        let n = generatePrice - z;
                                        let quarterlyInput = parseInt(parentAccordion.find('.quarterly-input').val()) || 0;
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

                                function updateQuarterlyPaymentSchedule(parentAccordion, quarterlyPayment, quarterlyCount) {
                                    let quarterlyPaymentSchedule = parentAccordion.find('.quarterly-payment-schedule');
                                    quarterlyPaymentSchedule.html('');
                                    let totalQuarterlyPayment = 0;
                                    for (let i = 1; i <= quarterlyCount; i++) {
                                        quarterlyPaymentSchedule.append(
                                            `<tr>
                                                <td>Chorak ${i}</td>
                                                <td>${Math.round(quarterlyPayment)}</td>
                                            </tr>`
                                        );
                                        totalQuarterlyPayment += quarterlyPayment;
                                    }
                                    parentAccordion.find('.total-quarterly-payment').html(Math.round(totalQuarterlyPayment));
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
                                        parentAccordion.find('.payment-schedule').html('');
                                        parentAccordion.find('.quarterly-payment-schedule').html('');
                                    } else {
                                        percentageInput.prop('disabled', false);
                                        quarterlyInput.prop('disabled', false);
                                    }

                                    calculateGeneratePrice(parentAccordion);
                                });


                            </script>

                            <!-- Confirm Details -->
                            <h3>@lang('global.confirmation')</h3>

                            <section>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                            </div>
                                            <div>
                                                <h5>@lang('global.confirmation')</h5>
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
