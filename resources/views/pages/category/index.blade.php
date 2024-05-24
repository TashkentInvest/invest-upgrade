@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@lang('cruds.category.title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">@lang('cruds.category.title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('cruds.category.title')</h3>
                <a href="{{ route('categoryAdd') }}" class="btn btn-sm btn-success waves-effect waves-light float-right">
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
                        <th>@lang('cruds.category.fields.name_uz')</th>
                        <th>@lang('cruds.category.fields.name_ru')</th>
                        {{-- <th>@lang('cruds.category.fields.branch_id')</th> --}}
                        <th>@lang('cruds.category.fields.parent_id')</th>
                        <th style="width: 150px;">@lang('global.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $item)
                        {{-- @dd($item) --}}
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name_uz }}</td>
                                <td>{{ $item->name_ru }}</td>
                                {{-- <td>{{ $item->branch->{'name_' . $locale } }}</td> --}}
                                <td>{{ isset($item->parent->name_ru) ? ("ID: ".$item->parent->id." ".$item->parent->name_ru) : '-' }}</td>
                                <td class="text-center">
                                    <form action="{{ route('categoryDestroy', $item->id) }}" method="post">
                                        @csrf
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{ route('categoryEdit', $item->id) }}" class="btn btn-primary">@lang('global.edit')</a>
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