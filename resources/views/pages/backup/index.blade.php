@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Backups</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">Backups</li>
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
                <h3 class="card-title">Audit Logs</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Size (KB)</th>
                            <th>Creation Date</th>
                            <th>Line Count</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backupDetails as $backup)
                        <tr>
                            <td>{{ basename($backup['file']) }}</td>
                            <td>{{ round($backup['size'] / 1024, 2) }}</td>
                            <td>{{ date('Y-m-d H:i:s', $backup['creation_date']) }}</td>
                            <td>{{ $backup['line_count'] }}</td>
                            <td class="d-flex">
                                <form action="{{ route('backup.download', basename($backup['file'])) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </form>
                                <form action="{{ route('backup.delete', basename($backup['file'])) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-2">Delete</button>
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

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "order": [[ 4, "desc" ]], // Order by the Timestamp column by default
            "pageLength": 10, // Show 10 entries per page by default
        });
    });
</script>
@endpush
