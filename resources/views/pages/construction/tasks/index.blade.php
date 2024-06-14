@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Customers</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive w-100">
                            <thead>
                                <tr>
                                    <th>@lang('global.id')</th>
                                    <th>@lang('global.client_name') / @lang('cruds.company.fields.company_name')</th>
                                    <th>@lang('cruds.client.fields.contact')</th>
                                    <th>@lang('cruds.company.fields.address')</th>
                                    <th>@lang('cruds.company.fields.stir')</th>
                                    <th style="width: 150px;">@lang('global.created_at')</th>
                                    <th style="width: 100px;">@lang('global.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($constructions as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}</td>

                                        @if ($item->mijoz_turi == 'fizik')
                                            <td>{{ $item->last_name }} {{ $item->first_name }} {{ $item->father_name }}</td>
                                        @else
                                            <td>{{ $item->company->company_name }} </td>
                                            {{-- @dump($item->company_name) --}}
                                        @endif

                                        <td>{{ $item->contact ?? '---' }}</td>
                                        @if ($item->mijoz_turi == 'fizik')
                                            <td>{{ $item->address->home_address }}</td>
                                        @else
                                            <td>{{ $item->address->yuridik_address }} </td>
                                        @endif

                                        <td>{{ $item->company->stir }} </td>


                                        <td> {{ $item->updated_at }} </td>
                                        <td class="text-center">
                                            <form action="{{ route('clientDestroy', $item->id) }}" method="post">
                                                @csrf
                                                <ul class="list-unstyled hstack gap-1 mb-0">



                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="@lang('global.view')">
                                                        <a href="{{ route('construction.show', $item->id) }}"
                                                            class="btn btn-success">
                                                            <i class="bx bxs-edit" style="font-size:16px;"></i>
                                                        </a>
                                                    </li>


                                                </ul>
                                            </form>
                                            <!-- Modal -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
