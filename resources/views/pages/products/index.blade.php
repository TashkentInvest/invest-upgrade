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
                        <li class="breadcrumb-item active">@lang('cruds.branches.title')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{-- <h3 class="card-title">@lang('cruds.branches.title')</h3> --}}
                    <a href="{{ route('clientAdd') }}" class="btn btn-sm btn-success waves-effect waves-light float-right">
                        <span class="fas fa-plus-circle"></span>
                        @lang('global.add')
                    </a>

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-success waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#exampleModal_filter">
                            <i class="fas fa-filter"></i> @lang('global.filter')
                        </button>
                        <form action="" method="get">
                            <div class="modal fade" id="exampleModal_filter" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">@lang('global.filter')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">


                                            <!-- Company Search -->
                                            <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>@lang('global.last_name')</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="company_operator">
                                                        <option value="like"
                                                            {{ request()->client_operator == 'like' ? 'selected' : '' }}>
                                                            Like</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="client_name_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="last_name"
                                                        value="{{ old('last_name', request()->last_name ?? '') }}">
                                                </div>
                                            </div>

                                            <!-- Company Search -->
                                            <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>@lang('global.company_name')</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="company_operator">
                                                        <option value="like"
                                                            {{ request()->company_operator == 'like' ? 'selected' : '' }}>
                                                            Like</option>
                                                        <!-- Add other comparison operators if needed -->
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="company_name_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="company_name"
                                                        value="{{ old('company_name', request()->company_name ?? '') }}">
                                                </div>
                                            </div>

                                            {{-- Inn search --}}
                                            <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>@lang('cruds.company.fields.stir')</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="stir_operator">
                                                        <option value="like"
                                                            {{ request()->stir_operator == 'like' ? 'selected' : '' }}>Like
                                                        </option>
                                                        <!-- Add other comparison operators if needed -->
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="stir_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="stir" value="{{ old('stir', request()->stir ?? '') }}">
                                                </div>
                                            </div>

                                            {{-- passport serial --}}
                                            <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>@lang('global.passport_serial')</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="passport_operator">
                                                        <option value="like"
                                                            {{ request()->passport_operator == 'like' ? 'selected' : '' }}>
                                                            Like</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="passport_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="passport_serial"
                                                        value="{{ old('passport_serial', request()->passport_serial ?? '') }}">
                                                </div>
                                            </div>

                                            {{-- passport serial --}}
                                            <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>@lang('global.passport_pinfl')</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="passport_operator">
                                                        <option value="like"
                                                            {{ request()->passport_operator == 'like' ? 'selected' : '' }}>
                                                            Like</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="passport_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="passport_pinfl"
                                                        value="{{ old('passport_pinfl', request()->passport_pinfl ?? '') }}">
                                                </div>
                                            </div>
                                            {{-- contact search --}}
                                            <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>@lang('cruds.client.fields.contact')</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="contact_operator">
                                                        <option value="like"
                                                            {{ request()->contact_operator == 'like' ? 'selected' : '' }}>
                                                            Like</option>
                                                        <!-- Add other comparison operators if needed -->
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="contact_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="contact"
                                                        value="{{ old('contact', request()->contact ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-3 col-md-4 col-sm-3 col-12">
                                                    <h6>@lang('global.created_at')</h6>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                                                    <select class="form-control form-control-sm"
                                                        name="created_at_operator"
                                                        onchange="
                                                                if(this.value == 'between'){
                                                                document.getElementById('created_at_pair').style.display = 'block';
                                                                } else {
                                                                document.getElementById('created_at_pair').style.display = 'none';
                                                                }
                                                                ">
                                                        <option value="like"
                                                            {{ request()->created_at_operator == '=' ? 'selected' : '' }}>
                                                            =
                                                        </option>
                                                        <option value=">"
                                                            {{ request()->created_at_operator == '>' ? 'selected' : '' }}>
                                                            >
                                                        </option>
                                                        <option value="<"
                                                            {{ request()->created_at_operator == '<' ? 'selected' : '' }}>
                                                            < </option>
                                                        <option value="between"
                                                            {{ request()->created_at_operator == 'between' ? 'selected' : '' }}>
                                                            От .. до .. </option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-4">
                                                    <input class="form-control form-control-sm" type="datetime-local"
                                                        name="created_at"
                                                        value="{{ old('created_at', request()->created_at ?? '') }}">
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-4" id="created_at_pair"
                                                    style="display: {{ request()->created_at_operator == 'between' ? 'block' : 'none' }}">
                                                    <input class="form-control form-control-sm" type="datetime-local"
                                                        name="created_at_pair"
                                                        value="{{ old('created_at_pair', request()->created_at_pair ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="box container text-center">
                                            <i class="bx bx-file " style="font-size: 20px"></i>
                                            <a class="border rounded " href="{{ route('select.columns') }}">Visit
                                                Exel</a>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="filter"
                                                class="btn btn-primary">@lang('global.filtering')</button>
                                            <button type="button" class="btn btn-outline-warning float-left pull-left"
                                                id="reset_form">@lang('global.clear')</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">@lang('global.closed')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light">Middle</button> --}}
                        <a href="{{ route('clientIndex') }}" class="btn btn-secondary waves-effect waves-light btn-sm">
                            <i class="bx bx-revision"></i> @lang('global.clear')
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Data table -->
                    <table class="table table-bordered dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>@lang('global.id')</th>
                                <th>@lang('global.client_name') || @lang('cruds.company.fields.company_name')</th>
                                <th>@lang('cruds.client.fields.contact')</th>
                                <th>@lang('cruds.company.fields.address')</th>
                                <th>@lang('cruds.company.fields.stir')</th>
                                <th>@lang('global.active')</th>
                                <th style="width: 150px;">@lang('global.created_at')</th>
                                <th style="width: 100px;">@lang('global.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $item)
                                <tr>
                                    <td class="{{ $item->files->isNotEmpty() ? '' : 'bg-secondary text-light' }}">
                                        {{ $item->id }}</td>

                                    @if ($item->mijoz_turi == 'fizik')
                                        <td>{{ $item->last_name }} {{ $item->first_name }} {{ $item->father_name }}</td>
                                    @else
                                    {{-- @dump($item) --}}
                                        <td>{{ $item->company->company_name }} </td>
                                        {{-- @dump($item->company_name) --}}
                                    @endif

                                    <td>{{ $item->contact ?? '---' }}</td>
                                    @if ($item->mijoz_turi == 'fizik')
                                        <td>{{ $item->address->home_address }}</td>
                                    @else
                                        <td>{{ $item->address->yuridik_address }} </td>
                                    @endif

                                    <td>{{ $item->company->stir }} </td>

                                    <td class="text-center">
                                        <i style="cursor: pointer; font-size: 16px;" id="program_{{ $item->id }}"
                                            class="fas {{ $item->status === 1 ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"
                                            onclick="toggle_instock({{ $item->id }})"></i>
                                    </td>
                                    <td> {{ $item->updated_at }} </td>
                                    <td class="text-center">
                                        <form action="{{ route('clientDestroy', $item->id) }}" method="post">
                                            @csrf
                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('global.details')">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal_{{ $item->id }}"
                                                        class="btn btn-primary">
                                                        <i class="bx bxs-show" style="font-size:16px;"></i>
                                                    </button>
                                                </li>

                                                @can('client.delete')
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="@lang('global.delete')">
                                                        <button onclick="if (confirm('Вы уверены?')) { this.form.submit() }"
                                                            type="button" data-bs-toggle="modal" class="btn btn-danger">
                                                            <i class="bx bxs-trash" style="font-size: 16px;"></i>
                                                        </button>
                                                    </li>
                                                @endcan

                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('global.edit')">
                                                    <a href="{{ route('clientEdit', $item->id) }}" class="btn btn-info">
                                                        <i class="bx bxs-edit" style="font-size:16px;"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('global.view')">
                                                    <a href="{{ route('clientDetails', $item->id) }}"
                                                        class="btn btn-success">
                                                        <i class="bx bxs-right-arrow-circle" style="font-size: 16px;"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </form>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ $item->{'name_' . app()->getLocale()} }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <tbody>

                                                                <tr>
                                                                    <td>@lang('global.fio')</td>
                                                                    <td>{{ $item->last_name }} {{ $item->first_name }}
                                                                        {{ $item->father_name }}</td>
                                                                </tr>


                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.contact')</td>
                                                                    <td>{{ $item->contact }}</td>
                                                                </tr>

                                                                <tr>
                                                                    @if ($item->mijoz_turi == 'fizik')
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.passport_serial')</td>
                                                                    <td>{{ $item->passport->passport_serial }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.passport_pinfl')</td>
                                                                    <td>{{ $item->passport->passport_pinfl }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.passport_date')</td>
                                                                    @if ($item->passport->passport_date)
                                                                        <td>{{ date('d-m-Y', strtotime($item->passport->passport_date)) }}
                                                                        </td>
                                                                    @else
                                                                        <td></td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.passport_location')</td>
                                                                    <td>{{ $item->passport->passport_location }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Is Id ?</td>
                                                                    @if ($item->passport->passport_type == 0)
                                                                        <td>Passport</td>
                                                                    @else
                                                                        <td>Id Card</td>
                                                                    @endif

                                                                </tr>

                                                                <tr>
                                                                    <td>@lang('global.home_address')</td>
                                                                    <td>{{ $item->address->home_address }}</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>@lang('cruds.company.fields.company_name')</td>
                                                                    <td>{{ $item->company->company_name }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>@lang('cruds.company.fields.raxbar')</td>
                                                                    <td>{{ $item->company->raxbar }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.company.fields.bank_code')</td>
                                                                    <td>{{ $item->company->bank_code }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.company.fields.bank_service')</td>
                                                                    <td>{{ $item->company->bank_service }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>@lang('cruds.company.fields.bank_account')</td>
                                                                    <td>{{ $item->company->bank_account }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>@lang('cruds.company.fields.oked')</td>
                                                                    <td>{{ $item->company->oked }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.yuridik_address')</td>
                                                                    <td>{{ $item->address->yuridik_address }}</td>
                                                                </tr>
                            @endif
                            </tr>

                            <tr>
                                <td>@lang('cruds.company.fields.stir')</td>
                                <td>{{ $item->company->stir }}</td>
                            </tr>

                            @foreach ($item->branches as $b)
                                <tr>
                                    <td class="text-center"><strong>Obyekt</strong>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>@lang('global.ruxsatnoma_raqami')</td>
                                    <td>{{ $b->contract_apt }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('global.sanasi')</td>
                                    <td>{{ $b->contract_date }}</td>
                                </tr>

                                <tr>
                                    <td>@lang('cruds.branches.fields.application_number')</td>
                                    <td>{{ $b->application_number }}</td>
                                </tr>

                                <tr>
                                    <td>@lang('global.loyiha_nomi')</td>
                                    <td>{{ $b->branch_name }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.branch_type')</td>
                                    <td>{{ $b->branch_type }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.branch_location')</td>
                                    <td>{{ $b->branch_location }}</td>
                                </tr>

                                <tr>
                                    <td>@lang('global.obyekt_boyicha_tolanishi_lozim')
                                    </td>
                                    <td>{{ number_format($b->branch_kubmetr, 1) }}</td>
                                </tr>

                                <tr>
                                    <td>@lang('global.jami_tolanishi_kerak')</td>
                                    <td>{{ $b->generate_price }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('global.bolib_tolash')</td>
                                    <td>
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

                                <tr>
                                    <td>@lang('cruds.branches.fields.payed_date')</td>
                                    <td>{{ $b->payed_date }}</td>
                                </tr>

                                <tr>
                                    <td>@lang('global.bolib_tolash_foizi_oldindan')</td>
                                    <td>{{ $b->percentage_input }} %</td>
                                </tr>


                                <tr>
                                    <td>@lang('cruds.branches.fields.notification_num')</td>
                                    <td>{{ $b->notification_num }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.branches.fields.notification_date')</td>
                                    <td>{{ $b->notification_date }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.branches.fields.insurance_policy')</td>
                                    <td>{{ $b->insurance_policy }}</td>
                                </tr>

                                <tr>
                                    <td>@lang('cruds.branches.fields.bank_guarantee')</td>
                                    <td>{{ $b->bank_guarantee }}</td>
                                </tr>

                                <tr>
                                    <td>@lang('global.quarterly_payment')</td>
                                    <td>{{ $b->installment_quarterly }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td><strong>Product Details</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>@lang('global.bazaviy_xisoblash_miqdori')</td>
                                <td>{{ $item->minimum_wage }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('global.closed')</button>
                </div>
            </div>
        </div>
    </div>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    <div class="d-flex">

        {!! $clients->links() !!}
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggle_instock(id) {
            $.ajax({
                url: "/clients/toggle-status/" + id,
                type: "POST",
                data: {
                    _token: "{!! @csrf_token() !!}"
                },
                success: function(result) {
                    if (result.is_active == 1) {
                        $("#program_" + id).attr('class', "fas fa-check-circle text-success");
                    } else {
                        $("#program_" + id).attr('class', "fas fa-times-circle text-danger");
                    }
                },
                error: function(errorMessage) {
                    console.log(errorMessage)
                }
            });
        }
    </script>

    {{-- <script>
    function updateData() {
        $.ajax({
            url: '{{ route("clientIndex") }}',
            method: 'GET',
            success: function(response) {
                $('#layout-wrapper').html(response);
                // console.log(response)
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    setInterval(updateData, 10000);
</script> --}}
@endsection
