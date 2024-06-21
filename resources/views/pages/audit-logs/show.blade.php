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


    <div class="row">
        <div class="col-12">
            <div>
                <h3>Client Information</h3>
                <p><strong>ID:</strong> {{ $client->id }}</p>
                <p><strong>Name:</strong> {{ $client->first_name }} {{ $client->last_name }}</p>
            
                <h4>Client History</h4>
                @if($clientHistory->isEmpty())
                    <p>No records found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientHistory as $history)
                            <tr>
                                <td>{{ $history->event }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            
                <h4>File Histories</h4>
                @if($fileHistories->isEmpty())
                    <p>No records found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Path</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fileHistories as $history)
                            <tr>
                                <td>{{ $history->path }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            
                <h4>Address Histories</h4>
                @if($addressHistories->isEmpty())
                    <p>No records found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Home Address</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addressHistories as $history)
                            <tr>
                                <td>{{ $history->home_address }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            
                <h4>Passport Histories</h4>
                @if($passportHistories->isEmpty())
                    <p>No records found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Passport Serial</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($passportHistories as $history)
                            <tr>
                                <td>{{ $history->passport_serial }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            
                <h4>Company Histories</h4>
                @if($companyHistories->isEmpty())
                    <p>No records found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companyHistories as $history)
                            <tr>
                                <td>{{ $history->company_name }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            
                <h4>Branch Histories</h4>
                @if($branchHistories->isEmpty())
                    <p>No records found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>APZ Raqami</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branchHistories as $history)
                            <tr>
                                <td>{{ $history->apz_raqami }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
