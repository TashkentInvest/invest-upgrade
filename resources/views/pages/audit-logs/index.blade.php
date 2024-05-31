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
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Client</th>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->user->name }} | {{ $log->user->email }}</td>
                                <td>{{ $log->client->first_name ?? 'N/A' }} {{ $log->client->last_name ?? '' }}</td>
                                <td>{{ $log->company->company_name ?? 'N/A' }}</td>
                                <td>{{ $log->event }}</td>
                                <td>
                                    @if($log->old_values)
                                        <pre>{{ pretty_json($log->old_values) }}</pre>
                                    @elsex
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($log->new_values)
                                        <pre>{{ pretty_json($log->new_values) }}</pre>
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
        </div>
    </div>
</div>

@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "order": [[ 6, "desc" ]], // Order by the Timestamp column by default
            "pageLength": 10, // Show 10 entries per page by default
        });
    });
</script>
@endpush
