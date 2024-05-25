@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@lang('cruds.branches.title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
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
                        <th>@lang('cruds.client.fields.first_name')</th>
                        <th>@lang('cruds.client.fields.contact')</th>
                        <th>@lang('cruds.company.title')</th>
                        <th style="width: 100px;">Active</th>
                        <th style="width: 150px;">@lang('global.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                        {{-- @dump($item->client) --}}
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->client_id }}</td>
                                <td>{{ $item->clients->contact ?? '' }}</td>
                                @foreach ($item->client->companies as $i)
                                <td>{{ $i->company_name ?? ''}}</td>
                                    
                                @endforeach
                             
                                <td class="text-center">
                                    <i style="cursor: pointer; font-size: 16px;" id="program_{{ $item->id }}" 
                                    class="fas {{ $item->status === 1 ? "fa-check-circle text-success":"fa-times-circle text-danger" }}"
                                    onclick="toggle_instock({{ $item->id }})"></i>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('productDestroy',$item->id) }}" method="post">
                                        @csrf
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('global.details')">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $item->id }}" class="btn btn-primary">
                                                    <i class="bx bxs-show" style="font-size:16px;"></i>
                                                </button>
                                            </li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('global.edit')">
                                                <a href="{{ route('productEdit',$item->id) }}" class="btn btn-info">
                                                    <i class="bx bxs-edit" style="font-size:16px;"></i>
                                                </a>
                                            </li>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('global.delete')">
                                                <button  onclick="if (confirm('Вы уверены?')) { this.form.submit() }" type="button" data-bs-toggle="modal" 
                                                class="btn btn-danger">
                                                    <i class="bx bxs-trash" style="font-size: 16px;"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </form>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $item->{'name_' . app()->getLocale()} }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                          
                                                            <tr>
                                                                <td class="text-start">Client Name:</td>
                                                                <td><b>{{ $item->client->first_name }} {{ $item->client->last_name }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-start">Client Father Name:</td>
                                                                <td><b>{{ $item->client->father_name }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-start">Client Type:</td>
                                                                <td><b>{{ $item->client->mijoz_turi }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-start">Client Address:</td>
                                                                <td><b>{{ $item->client->yuridik_address }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-start">Client Contact:</td>
                                                                <td><b>{{ $item->client->contact }}</b></td>
                                                            </tr>
                                                            <!-- Company Details -->
                                                            <tr>
                                                                <td class="text-start">Company Name:</td>
                                                                <td><b>{{ $item->company->company_name }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-start">Company Location:</td>
                                                                <td><b>{{ $item->company->company_location }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-start">Company Type:</td>
                                                                <td><b>{{ $item->company->company_type }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-start">Company Kubmetr:</td>
                                                                <td><b>{{ $item->company->company_kubmetr }}</b></td>
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function toggle_instock(id){
            $.ajax({
                url: "/product/toggle-status/"+id,
                type: "POST",
                data:{
                    _token: "{!! @csrf_token() !!}"
                },
                success: function(result){
                    if (result.is_active == 1){
                        $("#program_"+id).attr('class',"fas fa-check-circle text-success");
                    }
                    else
                    {
                        $("#program_"+id).attr('class',"fas fa-times-circle text-danger");
                    }
                },
                error: function (errorMessage){
                    console.log(errorMessage)
                }
            });
        }
    </script>
@endsection
