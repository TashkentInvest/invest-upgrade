@extends('layouts.admin')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Audit Logs</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">Audit Logs</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Audit Logs</h3>
               
            </div>
            <!-- /.card-header -->
            <div class="card-body">
             
                <h1>Audit Logs</h1>
            <table id="datatable" class="table table-bordered  w-100">>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company</th>
                        <th>Event</th>
                        <th>Old Values</th>
                        <th>New Values</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditLogs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->company->company_name ?? 'N/A' }}</td>
                            <td>{{ $log->event }}</td>
                            <td>
                                @if($log->old_values)
                                    <pre>{{ json_encode($log->old_values, JSON_PRETTY_PRINT) }}</pre>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($log->new_values)
                                    <pre>{{ json_encode($log->new_values, JSON_PRETTY_PRINT) }}</pre>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $log->created_at }}</td>
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