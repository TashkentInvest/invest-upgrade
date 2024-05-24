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
                    <li class="breadcrumb-item"><a href="{{ route('api-userIndex') }}" style="color: #007bff;">@lang('cruds.setting.start_message.title')</a></li>
                    <li class="breadcrumb-item active">@lang('global.edit')</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- Main content -->

<div class="row">
    <div class="col-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('global.edit')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('settingStartMessageUpdate', $message->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label>TEXT</label>
                                <textarea rows="8" name="text" class="form-control">{{ old('text', $message->text ) }}</textarea>
                            </div>
                            <div class="mb-2 {{ is_null($message->picture) ? 'col-12' : 'col-8' }}">
                                <label>Image</label>
                                <input class="form-control" id="formFileLg" name="picture" type="file" accept="image/jpeg, image/png, image/gif"
                                value="{{ old('picture', $message->picture ) }}">
                            </div>
                            @if(!is_null($message->picture))
                                <div class="col-4 mb-2">
                                    <div class="image-box float-right" style="width: 100px; height: 60px;">
                                        <img src="{{ url('/') }}/images/{{ $message->picture }}" alt="image_start_message" width="100%" height="100%">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-success waves-effect waves-light float-right">@lang('global.save')</button>
                        <a href="{{ route('settingStartMessage') }}" class="btn btn-light waves-effect float-left">@lang('global.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection