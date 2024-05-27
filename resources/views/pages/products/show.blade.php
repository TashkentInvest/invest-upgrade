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
                <div class="card-header">
                    <h3 class="card-title">@lang('cruds.branches.title')</h3>
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
                                <th>F.I.O</th>
                                <th>@lang('cruds.client.fields.contact')</th>
                                <th style="width: 100px;">Active</th>
                                <th style="width: 150px;">@lang('global.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                                {{-- @dump($client->companies[0]->company_name ) --}}

                                @if(isset($client))
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->first_name }} {{ $client->last_name }} {{ $client->father_name }}</td>
                                    
                                    <td>{{ $client->contact ?? '---' }}</td>

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
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_{{ $client->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ $client->{'name_' . app()->getLocale()} }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <tbody>

                                                                <tr>
                                                                    <td><strong>Shaxsiy Malumotlar</strong></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mijoz Turi</td>
                                                                    <td>{{ $client->mijoz_turi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td>{{ $client->first_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Last Name</td>
                                                                    <td>{{ $client->last_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Father Name</td>
                                                                    <td>{{ $client->father_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Passport Serial</td>
                                                                    <td>{{ $client->passport_serial }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Passport Pinfl</td>
                                                                    <td>{{ $client->passport_pinfl }}</td>
                                                                </tr>
                                                                <tr>
                                                                    {{-- @dd($client) --}}
                                                                    <td>Yuridik Address</td>
                                                                    <td>{{ $client->yuridik_address }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Yuridik Rekvizid</td>
                                                                    <td>{{ $client->yuridik_rekvizid }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Contact</td>
                                                                    <td>{{ $client->contact }}</td>
                                                                </tr>





                                                                @foreach ($client->companies as $comp)
                                                                    <tr>
                                                                        <td class="text-center"><strong>Obyekt</strong></td>
                                                                        <td></td>


                                                                    </tr>
                                                                    <tr>
                                                                        <td>Loyixa Manzili</td>
                                                                        <td>{{ $comp->company_location }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Loyixa Nomi</td>
                                                                        <td>{{ $comp->company_name }}</td>
                                                                    </tr>

                                                                    @foreach ($comp->branches as $b)
                                                                        <tr>
                                                                            <td class="text-center"><strong>Shartnoma
                                                                                    Rekvizitlari</strong></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>APT Raqami</td>
                                                                            <td>{{ $b->contract_apt }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Sanasi</td>
                                                                            <td>{{ $b->contract_date }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Obyekt bo'yicha tolanadigan yeg'im miqdori
                                                                            </td>
                                                                            <td>{{ $b->branch_kubmetr }}</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Jami to'lanishi kerak bo'gan miqdor</td>
                                                                            <td>{{ $b->generate_price }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>To'lash turlari</td>
                                                                            <td>{{ $b->payment_type }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Bo'lib to'lash foizi oldindan</td>
                                                                            <td>{{ $b->percentage_input }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Bo'lib to'lash kvartalniy</td>
                                                                            <td>{{ $b->installment_quarterly }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach

                                                                @foreach ($client->products as $p)
                                                                    <tr>
                                                                        <td><strong>Product Details</strong></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        {{-- @dd($comp->products) --}}
                                                                        <td>Bazaviy xisoblash miqdori</td>
                                                                        <td>{{ $p->minimum_wage }}</td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">@lang('global.closed')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
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
@endsection
