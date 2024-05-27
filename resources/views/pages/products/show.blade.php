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
                <div class="card-header">
                    <h3 class="card-title">@lang('cruds.branches.title') - {{ $client->id }}</h3>
                    <a href="{{ route('productAdd') }}" class="btn btn-sm btn-success waves-effect waves-light float-right">
                        <span class="fas fa-plus-circle"></span>
                        @lang('global.add')
                    </a>
                </div>
                <div class="card-body">

                    <!-- Data table -->
                    <table id="datatable" class="table table-bordered dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>ID</th>

                                <th>company name</th>

                                <th>F.I.O</th>

                                <th>@lang('cruds.client.fields.contact')</th>

                                <th>Mijoz Turi</th>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Father Name</th>
                                <th>Passport Serial</th>

                                <th>Passport Pinfl</th>
                                <th>Yuridik Address</th>
                                <th>Yuridik Rekvizid</th>
                                <th>Contact</th>

                                <th style="width: 100px;">Active</th>
                                <th style="width: 150px;">@lang('global.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dump($client->companies[0]->company_name ) --}}

                            @if (isset($client))
                                <tr>
                                    <td>{{ $client->id }}</td>

                                    <td>{{ $client->companies[0]->company_name }}</td>


                                    <td>{{ $client->first_name }} {{ $client->last_name }} {{ $client->father_name }}</td>

                                    <td>{{ $client->contact ?? '---' }}</td>


                                    <td>{{ $client->mijoz_turi }}</td>
                                    <td>{{ $client->first_name }}</td>


                                    <td>{{ $client->last_name }}</td>
                                    <td>{{ $client->father_name }}</td>

                                    <td>{{ $client->passport_serial }}</td>
                                    <td>{{ $client->passport_pinfl }}</td>

                                    <td>{{ $client->yuridik_address }}</td>

                                    <td>{{ $client->yuridik_rekvizid }}</td>
                                    <td>{{ $client->contact }}</td>

                                    <td class="text-center">
                                        <i style="cursor: pointer; font-size: 16px;" id="program_{{ $client->id }}"
                                            class="fas {{ $client->status === 1 ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"
                                            onclick="toggle_instock({{ $client->id }})"></i>
                                    </td>
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
                    <h3 class="card-title">Companya va Obyekt bo'yicha malumotlar</h3>

                </div>
                <div class="card-body">
                    <!-- Data table -->
                    <table id="datatable" class="table table-bordered dt-responsive w-100">

                        <tbody>
                            {{-- @dump($client->companies[0]->company_name ) --}}
                            @if (isset($client))
                                @foreach ($client->companies as $index => $comp)
                                    <tr>
                                        <td>ID</td>
                                        <td colspan="2">{{ $index + 1 }}</td>
                                    </tr>

                                    <tr>
                                        <td>Loyixa Manzili</td>
                                        <td colspan="2">{{ $comp->company_location }}</td>
                                    </tr>

                                    <tr>
                                        <td>Loyixa Nomi</td>
                                        <td colspan="2">{{ $comp->company_name }}</td>
                                    </tr>



                                    @foreach ($comp->branches as $b)
                                        <tr>
                                            <td colspan="3" class="text-center"><strong>Shartnoma
                                                    Rekvizitlari</strong></td>
                                        </tr>
                                        <tr>
                                            <td>APT Raqami</td>
                                            <td colspan="2">{{ $b->contract_apt }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sanasi</td>
                                            <td colspan="2">{{ $b->contract_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Obyekt bo'yicha to'lanadigan yeg'im miqdori</td>
                                            <td colspan="2">{{ $b->branch_kubmetr }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jami to'lanishi kerak bo'lgan miqdor</td>
                                            <td colspan="2">{{ $b->generate_price }}</td>
                                        </tr>
                                        <tr>
                                            <td>To'lash turlari</td>
                                            <td colspan="2">{{ $b->payment_type }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bo'lib to'lash foizi oldindan</td>
                                            <td colspan="2">{{ $b->percentage_input }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bo'lib to'lash kvartalniy</td>
                                            <td colspan="2">{{ $b->installment_quarterly }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
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
