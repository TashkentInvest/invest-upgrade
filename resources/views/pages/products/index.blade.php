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
                                <th>@lang('global.client_name')</th>
                                <th>@lang('cruds.client.fields.contact')</th>
                                <th>@lang('cruds.client.fields.mijoz_turi')</th>
                                <th>@lang('global.active')</th>
                                <th style="width: 150px;">@lang('global.created_at')</th>
                                <th style="width: 100px;">@lang('global.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $item)
                                {{-- @dump($item->companies[0]->company_name ) --}}
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->first_name }} {{ $item->last_name }} {{ $item->father_name }}</td>
                                    
                                    <td>{{ $item->contact ?? '---' }}</td>
                                    <td>
                                        @if($item->mijoz_turi == 'fizik')
                                            @lang('global.fizik')
                                        @else
                                            @lang('global.yuridik')
                                        @endif
                                    </td>


                                    <td class="text-center">
                                        <i style="cursor: pointer; font-size: 16px;" id="program_{{ $item->id }}"
                                            class="fas {{ $item->status === 1 ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"
                                            onclick="toggle_instock({{ $item->id }})"></i>
                                    </td>
                                    <td>
                                        {{$item->created_at}}
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('productDestroy', $item->id) }}" method="post">
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
                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('global.edit')">
                                                    <a href="{{ route('productEdit', $item->id) }}" class="btn btn-info">
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
                                                    <a href="{{ route('download.table.data', $item->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="bx bxs-download" style="font-size: 16px;"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="@lang('global.downloadFile')">
                                                <a href="{{ route('word', $item->id) }}"
                                                    class="btn btn-secondary">
                                                    <i class="bx bxs-download" style="font-size: 16px;"></i>
                                                </a>
                                            </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="@lang('global.view')">
                                                <a href="{{ route('productShow', $item->id) }}"
                                                    class="btn btn-success">
                                                    <i class="bx bxs-right-arrow-circle" style="font-size: 16px;"></i>

                                                </a>
                                            </li>
                                            </ul>
                                        </form>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-xl">
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
                                                                    <td><strong>@lang('global.personal_informations')</strong></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.mijoz_turi')</td>
                                                                    <td>{{ $item->mijoz_turi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.first_name')</td>
                                                                    <td>{{ $item->first_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.last_name')</td>
                                                                    <td>{{ $item->last_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.father_name')</td>
                                                                    <td>{{ $item->father_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.passport_serial')</td>
                                                                    <td>{{ $item->passport_serial }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.passport_pinfl')</td>
                                                                    <td>{{ $item->passport_pinfl }}</td>
                                                                </tr>
                                                                <tr>
                                                                    {{-- @dd($item) --}}
                                                                    <td>@lang('cruds.client.fields.yuridik_address')</td>
                                                                    <td>{{ $item->yuridik_address }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.yuridik_rekvizid')</td>
                                                                    <td>{{ $item->yuridik_rekvizid }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('cruds.client.fields.contact')</td>
                                                                    <td>{{ $item->contact }}</td>
                                                                </tr>


                                                                @foreach ($item->companies as $comp)
                                                                    <tr>
                                                                        <td class="text-center"><strong>Obyekt</strong></td>
                                                                        <td></td>


                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('cruds.company.fields.company_location')</td>
                                                                        <td>{{ $comp->company_location }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('cruds.company.fields.company_name')</td>
                                                                        <td>{{ $comp->company_name }}</td>
                                                                    </tr>

                                                                    @foreach ($comp->branches as $b)
                                                                        <tr>
                                                                            <td class="text-center"><strong>Shartnoma
                                                                                    Rekvizitlari</strong></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>@lang('global.ruxsatnoma_raqami')</td>
                                                                            <td>{{ $b->contract_apt }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>@lang('global.created_at')</td>
                                                                            <td>{{ $b->contract_date }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>@lang('global.obyekt_boyicha_tolanishi_lozim')
                                                                            </td>
                                                                            <td>{{ $b->branch_kubmetr }}</td>
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
                                                                            <td>@lang('global.bolib_tolash_foizi_oldindan')</td>
                                                                            <td>{{ $b->percentage_input }} %</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>@lang('global.quarterly_payment')</td>
                                                                            <td>{{ $b->installment_quarterly }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach

                                                                @foreach ($item->products as $p)
                                                                    <tr>
                                                                        <td><strong>Product Details</strong></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        {{-- @dd($comp->products) --}}
                                                                        <td>@lang('global.bazaviy_xisoblash_miqdori')</td>
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
                            @endforeach
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
