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
                    <li class="breadcrumb-item"><a href="{{ route('productIndex') }}" style="color: #007bff;">@lang('cruds.branches.title')</a></li>
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
                <form action="{{ route('productCreate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            @foreach(config('constants.locales') as $locale)
                            <div class="col-12 col-lg-6 mb-2">
                                <label>@lang('global.name_as') {{ $locale['title'] }}</label>
                                <input type="text" name="name_{{ $locale['short_name'] }}" class="form-control" value="{{ old('name_' . $locale['short_name']) }}" placeholder="Название" required>
                            </div>
                            @endforeach

                            @foreach(config('constants.locales') as $locale)
                            <div class="col-12 mb-2">
                                <label>@lang('global.description_as') {{ $locale['title'] }}</label>
                                <textarea id="textarea_{{$locale['short_name']}}" class="form-control" name="text_{{$locale['short_name']}}" maxlength="225" rows="3" placeholder="Описание ... " required></textarea>
                            </div>
                            @endforeach


                            <div class="col-12 col-lg-6 mb-2">
                                <label>@lang('cruds.branches.fields.longitude')</label>
                                <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}" placeholder="@lang('cruds.branches.fields.longitude')">
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <label>@lang('cruds.branches.fields.latitude')</label>
                                <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}" placeholder="@lang('cruds.branches.fields.latitude')">
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <label>@lang('cruds.branches.fields.region_id')</label>
                                <select class="form-control select2" style="width: 100%;" name="region_id" value="{{ old('region_id') }}" required>
                                    <option value="" disabled selected>@lang('cruds.regions_districts.districts.select_region')</option>
                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name_uz }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <label>@lang('cruds.category.title')</label>
                                <select class="form-control select2" style="width: 100%;" name="category_id" value="{{ old('category_id') }}" required>
                                    <option value="" disabled selected>@lang('cruds.category.title')</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_uz }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <label>@lang('cruds.branches.fields.photo')</label>
                                <input type="file" name="photo" class="form-control" accept="image/jpeg, image/png, image/gif">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-success waves-effect waves-light float-right">@lang('global.save')</button>
                        <a href="{{ route('productIndex') }}" class="btn btn-light waves-effect float-left">@lang('global.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection