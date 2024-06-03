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

<style>
    .card-body {
        overflow-x: scroll !important;
    }
</style>



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
                            <th>Actions</th>
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
                                <td class="text-center">
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="@lang('global.details')">
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
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ $log->{'name_' . app()->getLocale()} }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-striped">
                                                        <tbody>

                                                            <tr>
                                                                <td><strong>@lang('global.personal_informations')</strong></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('cruds.client.fields.mijoz_turi')</td>
                                                                <td>{{ $log->mijoz_turi ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('cruds.client.fields.first_name')</td>
                                                                <td>{{ $log->first_name ?? ''}}</td>
                                                            </tr>
                                                         

                                                            {{--  --}}

                                                            {{-- 
                                                            @foreach ($item->products as $p)
                                                                <tr>
                                                                    <td><strong>Product Details</strong></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('global.bazaviy_xisoblash_miqdori')</td>
                                                                    <td>{{ $p->minimum_wage }}</td>
                                                                </tr>
                                                            @endforeach --}}

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">@lang('global.closed')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
            "order": [[ 6, "desc" ]], // Order by the Timestamp column by default
            "pageLength": 10, // Show 10 entries per page by default
        });
    });
</script>
@endpush
