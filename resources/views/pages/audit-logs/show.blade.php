@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@lang('cruds.audit_logs.title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">@lang('cruds.audit_logs.title')</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Client Information')</h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <strong>@lang('ID'):</strong> {{ $client->id }}<br>
                    <strong>@lang('Name'):</strong> {{ $client->first_name }} {{ $client->last_name }}
                </div>

                @foreach ($histories as $type => $history)
                    @if (!$history->isEmpty())
                        <div class="mb-4">
                            <h4>@lang(ucfirst($type) . ' Histories')</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang(ucfirst($type))</th>
                                            <th>@lang('Old Value')</th>
                                            <th>@lang('New Value')</th>
                                            <th>@lang('Timestamp')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($history as $record)
                                            <tr>
                                                <td>{{ $record->{$type . '_name'} ?? $record->{$type . '_serial'} ?? $record->{$type . '_address'} }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($record->getOriginal() as $key => $value)
                                                            <li>{{ $key }}: {{ $value }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($record->getAttributes() as $key => $value)
                                                            <li>
                                                                @if (isset($client->{$key}) && $client->{$key} != $value)
                                                                    <span class="highlight-diff">{{ $client->{$key} }}</span>
                                                                @else
                                                                    {{ $value }}
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $record->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .highlight-diff {
        background-color: #ffdddd;
    }
</style>

@endsection
