@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">@lang('cruds.branches.title') - {{ $client->id }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('cruds.branches.title') - {{ $client->id }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="btn-toolbar">

                        <div class="btn-group dropdown-btn-group pull-right">
                            <button type="button" class="btn btn-default btn btn-primary">Display all</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                Display <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @php
                                    $columns = [
                                        ['name' => __('global.id'), 'data-priority' => 1, 'default' => true],
                                        ['name' => __('global.company_name'), 'data-priority' => 2, 'default' => true],
                                        ['name' => __('global.fio'), 'data-priority' => 3, 'default' => true],
                                        ['name' => __('global.contact'), 'data-priority' => 4, 'default' => true],
                                        ['name' => __('global.mijoz_turi'), 'data-priority' => 5, 'default' => true],
                                        ['name' => __('global.name'), 'data-priority' => 6, 'default' => true],
                                        ['name' => __('global.last_name'), 'data-priority' => 7, 'default' => true],
                                        ['name' => __('global.father_name'), 'data-priority' => 8, 'default' => true],
                                        [
                                            'name' => __('global.passport_serial'),
                                            'data-priority' => 9,
                                            'default' => false,
                                        ],
                                        [
                                            'name' => __('global.passport_pinfl'),
                                            'data-priority' => 10,
                                            'default' => false,
                                        ],
                                        [
                                            'name' => __('global.passport_pinfl'),
                                            'data-priority' => 11,
                                            'default' => false,
                                        ],
                                        [
                                            'name' => __('global.yuridik_address'),
                                            'data-priority' => 12,
                                            'default' => false,
                                        ],
                                        [
                                            'name' => __('global.yuridik_rekvizid'),
                                            'data-priority' => 13,
                                            'default' => false,
                                        ],
                                        ['name' => __('global.contact'), 'data-priority' => 14, 'default' => true],
                                        ['name' => __('global.actions'), 'data-priority' => 15, 'default' => true],
                                    ];
                                @endphp
                                @foreach ($columns as $index => $column)
                                    <li class="checkbox-row">
                                        <input type="checkbox" class="toggle-column" id="toggle-column-{{ $index }}"
                                            data-column="{{ $index }}" {{ $column['default'] ? 'checked' : '' }}>
                                        <label for="toggle-column-{{ $index }}">{{ $column['name'] }}</label>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>

                    <!-- Data table -->
                    <table id="datatable" class="table table-striped focus-on">
                        <thead>
                            <tr>
                                @foreach ($columns as $index => $column)
                                    <th data-priority="{{ $column['data-priority'] }}"
                                        class="{{ $column['default'] ? '' : 'd-none' }}">{{ $column['name'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($client))
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->companies[0]->company_name }}</td>
                                    <td>{{ $client->first_name }} {{ $client->last_name }} {{ $client->father_name }}
                                    </td>
                                    <td>{{ $client->contact ?? '---' }}</td>
                                    <td>{{ $client->mijoz_turi }}</td>
                                    <td>{{ $client->first_name }}</td>
                                    <td>{{ $client->last_name }}</td>
                                    <td>{{ $client->father_name }}</td>
                                    <td class="d-none">{{ $client->passport_serial }}</td>
                                    <td class="d-none">{{ $client->passport_pinfl }}</td>
                                    <td class="d-none">
                                        {{ $client->passport_type ? $client->passport_type == 'Id' : ($client->passport_type = 'Passport') }}
                                    </td>
                                    <td class="d-none">{{ $client->yuridik_address }}</td>
                                    <td class="d-none">{{ $client->yuridik_rekvizid }}</td>
                                    <td>{{ $client->contact }}</td>

                                    <td class="text-center">
                                        <form action="{{ route('productDestroy', $client->id) }}" method="post">
                                            @csrf
                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('global.edit')">
                                                    <a href="{{ route('productEdit', $client->id) }}" class="btn btn-info">
                                                        <i class="bx bxs-edit" style="font-size:16px;"></i>
                                                    </a>
                                                </li>
                                                <input name="_method" type="hidden" value="DELETE">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('global.delete')">
                                                    <button onclick="if (confirm('Вы уверены?')) { this.form.submit() }"
                                                        type="button" data-bs-toggle="modal" class="btn btn-danger">
                                                        <i class="bx bxs-trash" style="font-size: 16px;"></i>
                                                    </button>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('global.downloadFile')">
                                                    <a href="{{ route('download.table.data', $client->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="bx bxs-download" style="font-size: 16px;"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('global.downloadFile')">
                                                    <a href="{{ route('word', $client->id) }}" class="btn btn-secondary">
                                                        <i class="bx bxs-download" style="font-size: 16px;"></i>
                                                    </a>
                                                </li>
                                           
                                            </ul>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('global.company_and_object_detail')</h3>

                </div>
                <div class="card-body">
                    <!-- Data table -->
                    <table id="datatable" class="table table-bordered dt-responsive w-100">

                        <tbody>
                            {{-- @dump($client->companies[0]->company_name ) --}}
                            @if (isset($client))
                                {{-- @dd($client->companies) --}}
                                @foreach ($client->companies as $index => $comp)
                                {{-- @dump($comp) --}}
                                    <tr>
                                        <td>@lang('global.id')</td>
                                        <td colspan="2">{{ $index + 1 }}</td>
                                    </tr>

                                    <tr>
                                        <td>@lang('cruds.company.fields.company_location')</td>
                                        <td colspan="2">{{ $comp->company_location }}</td>
                                    </tr>

                                    <tr>
                                        <td>@lang('cruds.company.fields.company_name')</td>
                                        <td colspan="2">{{ $comp->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('global.loyiha_turi')</td>
                                        <td colspan="2">{{ $comp->company_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.company.fields.raxbar')</td>
                                        <td colspan="2">{{ $comp->raxbar }}</td>
                                    </tr>

                                    <tr>
                                        <td>@lang('cruds.company.fields.bank_code')</td>
                                        <td colspan="2">{{ $comp->bank_code }}</td>
                                    </tr>

                                    <tr>
                                        <td>@lang('cruds.company.fields.bank_service')</td>
                                        <td colspan="2">{{ $comp->bank_service }}</td>
                                    </tr>

                                    <tr>
                                        <td>@lang('cruds.company.fields.stir')</td>
                                        <td colspan="2">{{ $comp->stir }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('cruds.company.fields.oked')</td>
                                        <td colspan="2">{{ $comp->oked }}</td>
                                    </tr>


                                    @foreach ($comp->branches as $b)
                                        <tr>
                                            <td colspan="3" class="text-center"><strong>@lang('global.contract_details') - {{$b->contract_apt}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>@lang('global.ruxsatnoma_raqami')</td>
                                            <td colspan="2">{{ $b->contract_apt }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('global.created_at')</td>
                                            <td colspan="2">{{ $b->contract_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('global.obyekt_boyicha_tolanishi_lozim')</td>
                                            <td colspan="2">{{ $b->branch_kubmetr }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('global.jami_tolanishi_kerak')</td>
                                            <td colspan="2">{{ $b->generate_price }}</td>
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
                                            <td>@lang('global.bolib_tolash_foizi_oldindan')</td>
                                            <td colspan="2">{{ $b->percentage_input }}%</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('global.quarterly_payment')</td>
                                            <td colspan="2">{{ $b->installment_quarterly }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach

                                @if ($files->isNotEmpty())
                                    <h4>@lang('global.downloadFile')</h4>
                                    <ul>
                                        @foreach ($files as $file)
                                            <li>
                                                <a target="_blank" href="{{ asset($file->path) }}">{{$file->path}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No files uploaded for this product.</p>
                                @endif




                            @endif
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')


@section('scripts')
    <script>
        $(document).ready(function() {
            // Toggle column visibility
            $('.toggle-column').change(function() {
                var column = $(this).data('column');
                var isChecked = $(this).is(':checked');
                var table = $('#datatable');

                table.find('tr').each(function() {
                    if (isChecked) {
                        $(this).find('th').eq(column).removeClass('d-none');
                        $(this).find('td').eq(column).removeClass('d-none');
                    } else {
                        $(this).find('th').eq(column).addClass('d-none');
                        $(this).find('td').eq(column).addClass('d-none');
                    }
                });
            });

            // Hide columns by default
            $('.toggle-column').each(function() {
                var column = $(this).data('column');
                if (!$(this).is(':checked')) {
                    var table = $('#datatable');
                    table.find('tr').each(function() {
                        $(this).find('th').eq(column).addClass('d-none');
                        $(this).find('td').eq(column).addClass('d-none');
                    });
                }
            });


        });
    </script>
    <script>
        function toggle_instock(id) {
            $.ajax({
                url: "/product/toggle-status/" + id,
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

    <script src="{{ asset('assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('assets/js/pages/table-responsive.init.js') }}"></script>
@endsection
