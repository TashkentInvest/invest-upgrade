@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@lang('cruds.job.programs')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">@lang('cruds.job.programs')</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('cruds.job.programs')</h3>
                <a href="{{ route('jobProgramAdd') }}" class="btn btn-sm btn-success waves-effect waves-light float-right">
                    <span class="fas fa-plus-circle"></span>
                    @lang('global.add')
                </a>
            </div>
            <div class="card-body">
                <!-- Data table -->
                <table id="datatable" class="table table-bordered dt-responsive  w-100">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>@lang('cruds.job.fields.name_uz')</th>
                        <th>@lang('cruds.job.fields.name_ru')</th>
                        <th style="width: 100px;">Active</th>
                        <th class="w-25">@lang('global.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name_uz }}</td>
                                <td>{{ $item->name_ru }}</td>
                                <td class="text-center">
                                    <i style="cursor: pointer; font-size: 16px;" id="program_{{ $item->id }}" 
                                    class="fas {{ $item->status === 1 ? "fa-check-circle text-success":"fa-times-circle text-danger" }}"
                                    onclick="toggle_instock({{ $item->id }})"></i>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('jobProgramDestroy', $item->id) }}" method="post">
                                        @csrf
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{ route('jobProgramEdit', $item->id) }}" class="btn btn-primary">@lang('global.edit')</a>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button onclick="if (confirm('Вы уверены?')) { this.form.submit() }" 
                                                type="button" class="btn btn-danger">@lang('global.delete')</button>
                                        </div>
                                    </form>
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
                url: "/job-program/toggle-status/"+id,
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