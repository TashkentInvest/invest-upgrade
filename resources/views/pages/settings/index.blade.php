@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@lang('cruds.setting.start_message.title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">@lang('cruds.setting.start_message.title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">@lang('cruds.setting.start_message.title')</h3>
                @if(count($message) === 0)
                    <a href="{{ route('settingStartMessageAdd') }}" class="btn btn-sm btn-primary waves-effect waves-light float-right">
                        <span class="fas fa-plus-circle"></span>
                        @lang('global.add')
                    </a>
                @endif
            </div>
            <div class="card-body">
                        <!-- Data table -->
                <table  class="table table-bordered table-striped  dtr-inline table-responsive-lg" role="grid" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>TEXT</th>
                        <th>Image</th>
                        <th class="w-25">@lang('global.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($message as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->text }}</td>
                                <td>
                                    @if(!is_null($item->picture))
                                        <a target="_blank"  href="{{ url('/') }}/images/{{ $item->picture }}">{{ $item->picture }}</a>
                                    @else
                                        Empty
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('settingStartMessageEdit',$item->id) }}" type="button" class="btn btn-info btn-sm"> @lang('global.edit')</a>
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