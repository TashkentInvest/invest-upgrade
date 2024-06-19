@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">@lang('cruds.audit_logs.title')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('cruds.audit_logs.title')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-body {
            overflow-x: scroll !important;
        }

        .highlight-diff {
            background-color: #ffdddd;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('cruds.audit_logs.title')</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>@lang('global.id')</th>
                                <th>@lang('cruds.user.title_singular')</th>
                                <th>@lang('cruds.client.title_singular')</th>
                                <th>@lang('global.subject')</th>
                                <th>@lang('global.created_at')</th>
                                <th>@lang('global.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($auditLogs as $log)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $log->user->name }} | {{ $log->user->email }}</td>
                                    <td>{{ $log->client->first_name ?? 'N/A' }} {{ $log->client->last_name ?? '' }}</td>
                                    <td>{{ $log->event }}</td>
                                    <td>{{ $log->created_at }}</td>
                                    <td class="text-center">
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('global.details')">
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal_{{ $log->id }}"
                                                    class="btn btn-primary">
                                                    <i class="bx bxs-show" style="font-size:16px;"></i>
                                                </button>
                                            </li>
                                        </ul>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_{{ $log->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Audit Log Details
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2" class="table-active">
                                                                        <strong>@lang('global.personal_informations')</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Changed by</td>
                                                                    <td colspan="2">
                                                                        {{ $log->user->name }} <br>
                                                                        {{ $log->user->email }} <br>
                                                                        {{ optional($log->user->roles->first())->name }}
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 150px;"
                                                                        class="font-weight-bold text-primary">
                                                                        @lang('global.label_field')</td>
                                                                    <td style="width: 150px;"
                                                                        class="font-weight-bold text-primary">
                                                                        @lang('global.old_values')</td>
                                                                    <td style="width: 150px;"
                                                                        class="font-weight-bold text-success">
                                                                        @lang('global.new_values')</td>
                                                                </tr>
                                                                @php
                                                                    $oldValues =
                                                                        json_decode($log->old_values, true) ?? [];
                                                                    $newValues =
                                                                        json_decode($log->new_values, true) ?? [];
                                                                @endphp

                                                                @foreach (array_keys(array_merge($oldValues, $newValues)) as $key)
                                                                    @php
                                                                        $oldValue = isset($oldValues[$key])
                                                                            ? $oldValues[$key]
                                                                            : 'N/A';
                                                                        $newValue = isset($newValues[$key])
                                                                            ? $newValues[$key]
                                                                            : 'N/A';
                                                                        $highlight =
                                                                            $oldValue !== $newValue
                                                                                ? 'highlight-diff'
                                                                                : '';
                                                                    @endphp
                                                                    <tr>
                                                                        <td><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                                        </td>
                                                                        <td class="{{ $highlight }}">
                                                                            {{ $oldValue }}</td>
                                                                        <td class="{{ $highlight }}">
                                                                            {{ $newValue }}</td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>

                                                        </table>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex">

                        {!! $auditLogs->links() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
