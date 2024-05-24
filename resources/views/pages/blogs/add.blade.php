@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@lang('cruds.blogs.title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blogIndex') }}" style="color: #007bff;">@lang('cruds.blogs.title')</a></li>
                    <li class="breadcrumb-item active">@lang('global.add')</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('global.add')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('blogCreate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            @foreach(config('constants.locales') as $locale)
                                <div class="col-12 col-lg-6 mb-2">
                                    <label>@lang('global.name_as')  {{ $locale['title'] }}</label>
                                    <input type="text" name="name_{{ $locale['short_name'] }}" class="form-control" 
                                    value="{{ old('name_' . $locale['short_name']) }}" placeholder="Название" required>
                                </div>
                            @endforeach

                            @foreach(config('constants.locales') as $locale)
                                <div class="col-12 mb-2">
                                    <label>@lang('global.description_as')  {{ $locale['title'] }}</label>
                                    <textarea id="textarea_{{$locale['short_name']}}" class="form-control" name="text_{{$locale['short_name']}}" 
                                    maxlength="225" rows="3" placeholder="Описание ... " required></textarea>
                                </div>
                            @endforeach
                    
                            <div class="col-12 col-lg-6 mb-2">
                                <label>@lang('cruds.blogs.fields.photo')</label>
                                <input type="file" name="photo" class="form-control" accept="image/jpeg, image/png, image/gif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-success waves-effect waves-light float-right">@lang('global.save')</button>
                        <a href="{{ route('blogIndex') }}" class="btn btn-light waves-effect float-left">@lang('global.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection