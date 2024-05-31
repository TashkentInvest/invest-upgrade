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

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-success waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#exampleModal_filter">
                            <i class="fas fa-filter"></i> @lang('global.filter')
                        </button>
                        <form action="" method="get">
                            <div class="modal fade" id="exampleModal_filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">@lang('global.filter')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
    
                                                <!-- Company Search -->
                                                <div class="form-group row align-items-center my-2">
                                                    <div class="col-3">
                                                        <h6>@lang('cruds.company.fields.company_name')</h6>
                                                    </div>
                                                    <div class="col-2">
                                                        <select class="form-control form-control-sm" name="company_operator">
                                                            <option value="like" {{ request()->company_operator == 'like' ? 'selected' : '' }}>Like</option>
                                                            <!-- Add other comparison operators if needed -->
                                                        </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="hidden" name="company_name_operator" value="like">
                                                        <input class="form-control form-control-sm" type="text" name="company_name" value="{{ old('company_name', request()->company_name ?? '') }}">
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group row align-items-center my-2">
                                                    <div class="col-3">
                                                        <h6>@lang('cruds.company.fields.company_name') INN</h6>
                                                    </div>
                                                    <div class="col-2">
                                                        <select class="form-control form-control-sm" name="companystir_operator">
                                                            <option value="like" {{ request()->companystir_operator == 'like' ? 'selected' : '' }}>Like</option>
                                                            <!-- Add other comparison operators if needed -->
                                                        </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="hidden" name="companystir_operator" value="like">
                                                        <input class="form-control form-control-sm" type="text" name="stir" value="{{ old('stir', request()->stir ?? '') }}">
                                                    </div>
                                                </div> --}}
        
                                                
                                                <!-- Company Search End-->
        
                                                
                                            {{-- <!-- Category Search -->
                                            <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>Category Name</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="category_operator">
                                                        <option value="like" {{ request()->category_operator == 'like' ? 'selected' : '' }}>Like</option>
                                                        <!-- Add other comparison operators if needed -->
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="category_name_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text" name="category_name" value="{{ old('category_name', request()->category_name ?? '') }}">
                                                </div>
                                            </div> --}}
        
                                            <!-- Category Search End-->
        
                                              <!-- driver Search -->
                                              {{-- <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>Driver Name</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="driver_operator">
                                                        <option value="like" {{ request()->driver_operator == 'like' ? 'selected' : '' }}>Like</option>
                                                        <!-- Add other comparison operators if needed -->
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="driver_full_name_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text" name="driver_full_name" value="{{ old('driver_full_name', request()->driver_full_name ?? '') }}">
                                                </div>
                                            </div> --}}
        
                                            <!-- driver Search End-->
        
        
                                            {{-- Task status --}}
                                            {{-- <div class="form-group row align-items-center my-2">
                                                <div class="col-3">
                                                    <h6>User Name</h6>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control form-control-sm" name="status_operator">
                                                        <option value="like" {{ request()->status_operator == 'like' ? 'selected' : '' }}>Like</option>
                                                        <!-- Add other comparison operators if needed -->
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="user_name_operator" value="like">
                                                    <input class="form-control form-control-sm" type="text" name="user_name" value="{{ old('user_name', request()->user_name ?? '') }}">
                                                </div>
                                            </div> --}}
                                            {{-- Task status end --}}
                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-3 col-md-4 col-sm-3 col-12">
                                                    <h6>@lang('global.created_at')</h6>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                                                    <select class="form-control form-control-sm" name="created_at_operator"
                                                        onchange="
                                                                if(this.value == 'between'){
                                                                document.getElementById('created_at_pair').style.display = 'block';
                                                                } else {
                                                                document.getElementById('created_at_pair').style.display = 'none';
                                                                }
                                                                ">
                                                        <option value="like" {{ request()->created_at_operator == '=' ? 'selected':'' }}> = </option>
                                                        <option value=">" {{ request()->created_at_operator == '>' ? 'selected':'' }}> > </option>
                                                        <option value="<" {{ request()->created_at_operator == '<' ? 'selected':'' }}> < </option>
                                                        <option value="between" {{ request()->created_at_operator == 'between' ? 'selected':'' }}> От .. до .. </option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-4">
                                                    <input class="form-control form-control-sm" type="date" name="created_at" 
                                                    value="{{ old('created_at',request()->created_at??'') }}">
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-4" id="created_at_pair" style="display: {{ request()->created_at_operator == 'between' ? 'block':'none'}}">
                                                    <input class="form-control form-control-sm" type="date" name="created_at_pair" value="{{ old('created_at_pair',request()->created_at_pair??'') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box container">
                                            <a href="{{route('download.excel')}}">Download all of Exel</a>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="filter" class="btn btn-primary">@lang('global.filtering')</button>
                                            <button type="button" class="btn btn-outline-warning float-left pull-left" id="reset_form">@lang('global.clear')</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('global.closed')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light">Middle</button> --}}
                        <a href="{{ route('productIndex') }}" class="btn btn-secondary waves-effect waves-light btn-sm">
                            <i class="bx bx-revision"></i> @lang('global.clear')
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Data table -->
                    <table id="datatable" class="table table-bordered dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('global.client_name') || Yurik</th>
                                <th>@lang('cruds.company.fields.stir')</th>
                                <th>@lang('cruds.client.fields.contact')</th>
                                {{-- <th>@lang('cruds.client.fields.mijoz_turi')</th> --}}
                                <th>@lang('cruds.company.fields.address')</th>
                                <th>@lang('global.active')</th>
                                <th style="width: 150px;">@lang('global.created_at')</th>
                                <th style="width: 100px;">@lang('global.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $item)
                                {{-- @dump($item->companies[0]->company_name ) --}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if($item->mijoz_turi == 'fizik')
                                    <td>{{ $item->first_name }} {{ $item->last_name }} {{ $item->father_name }}</td>
                                    @else
                                        
                                    <td>{{ $item->companies[0]->company_name}} </td>

                                    @endif
                                    <td>{{ $item->companies[0]->stir }} </td>

                                    
                                    <td>{{ $item->contact ?? '---' }}</td>
                                    <td>{{ $item->address ?? '---' }}</td>
                                    {{-- <td>
                                        @if($item->mijoz_turi == 'fizik')
                                            @lang('global.fizik')
                                        @else
                                            @lang('global.yuridik')
                                        @endif
                                    </td> --}}


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
                                            <a href="{{ route('productEdit', $item->id) }}" class="btn btn-info">
                                                <i class="bx bxs-edit" style="font-size:16px;"></i>
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
