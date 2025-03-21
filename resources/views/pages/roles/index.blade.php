@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@lang('cruds.role.title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">@lang('cruds.role.title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<!-- Main content -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('cruds.role.title_singular')</h3>
                @can('roles.add')
                <a href="{{ route('roleAdd') }}" class="btn btn-sm btn-success waves-effect waves-light float-right">
                    <span class="fas fa-plus-circle"></span>
                    @lang('global.add')
                </a>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Data table -->
                <table id="datatable" class="table table-bordered dt-responsive w-100">
                    <thead>
                        <tr>
                            <th>@lang('cruds.role.fields.id')</th>
                            <th>@lang('cruds.role.fields.name')</th>
                            <th>@lang('cruds.role.fields.title')</th>
                            <th>@lang('cruds.role.fields.permissions')</th>
                            <th class="w-25">@lang('global.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->title }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                <span class="badge badge-soft-primary">{{ $permission->name }} </span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @can('roles.delete')
                                <form action="{{ route('roleDestroy',$role->id) }}" method="post">
                                    @csrf
                                    <div class="btn-group">
                                        @can('roles.edit')
                                        <a href="{{ route('roleEdit',$role->id) }}" type="button" class="btn btn-info btn-sm waves-effect waves-light"> @lang('global.edit')</a>
                                        @endcan
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="button" class="btn btn-danger waves-effect btn-sm waves-light" onclick="if (confirm('Вы уверены?')) { this.form.submit() } "> @lang('global.delete')</button>
                                    </div>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@endsection