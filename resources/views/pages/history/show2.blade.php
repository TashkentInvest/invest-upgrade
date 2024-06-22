<!-- resources/views/pages/history/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Client Details for {{ $clientHistory->client->first_name }} {{ $clientHistory->client->last_name }}</h1>
    <h2>Client ID: {{ $clientHistory->client_id }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <!-- Passport Histories -->
            <h3>Passport Histories</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Event</th>
                        <th>Passport Serial</th>
                        <th>Passport PINFL</th>
                        <th>Passport Date</th>
                        <th>Passport Location</th>
                        <th>Passport Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientHistory->passportHistories as $history)
                    <tr>
                        <td>{{ $history->user_id }}</td>
                        <td>{{ $history->event }}</td>
                        <td>{{ $history->passport_serial }}</td>
                        <td>{{ $history->passport_pinfl }}</td>
                        <td>{{ $history->passport_date }}</td>
                        <td>{{ $history->passport_location }}</td>
                        <td>{{ $history->passport_type }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- File Histories -->
            <h3>File Histories</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Event</th>
                        <th>Path</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientHistory->fileHistories as $history)
                    <tr>
                        <td>{{ $history->user_id }}</td>
                        <td>{{ $history->event }}</td>
                        <td>{{ $history->path }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Company Histories -->
            <h3>Company Histories</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Event</th>
                        <th>Company Name</th>
                        <th>Raxbar</th>
                        <th>Bank Code</th>
                        <th>Bank Service</th>
                        <th>Bank Account</th>
                        <th>STIR</th>
                        <th>OKED</th>
                        <th>Minimum Wage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientHistory->companyHistories as $history)
                    <tr>
                        <td>{{ $history->user_id }}</td>
                        <td>{{ $history->event }}</td>
                        <td>{{ $history->company_name }}</td>
                        <td>{{ $history->raxbar }}</td>
                        <td>{{ $history->bank_code }}</td>
                        <td>{{ $history->bank_service }}</td>
                        <td>{{ $history->bank_account }}</td>
                        <td>{{ $history->stir }}</td>
                        <td>{{ $history->oked }}</td>
                        <td>{{ $history->minimum_wage }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Branch Histories -->
            <h3>Branch Histories</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Event</th>
                        <th>Contract APT</th>
                        <th>Contract Date</th>
                        <th>APZ Raqami</th>
                        <th>APZ Sanasi</th>
                        <th>Kengash</th>
                        <th>Generate Price</th>
                        <th>Payment Type</th>
                        <th>Percentage Input</th>
                        <th>Installment Quarterly</th>
                        <th>Branch Kubmetr</th>
                        <th>Branch Location</th>
                        <th>Branch Type</th>
                        <th>Branch Name</th>
                        <th>Notification Num</th>
                        <th>Notification Date</th>
                        <th>Insurance Policy</th>
                        <th>Bank Guarantee</th>
                        <th>Application Number</th>
                        <th>Payed Sum</th>
                        <th>Payed Date</th>
                        <th>First Payment Percent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientHistory->branchHistories as $history)
                    <tr>
                        <td>{{ $history->user_id }}</td>
                        <td>{{ $history->event }}</td>
                        <td>{{ $history->contract_apt }}</td>
                        <td>{{ $history->contract_date }}</td>
                        <td>{{ $history->apz_raqami }}</td>
                        <td>{{ $history->apz_sanasi }}</td>
                        <td>{{ $history->kengash }}</td>
                        <td>{{ $history->generate_price }}</td>
                        <td>{{ $history->payment_type }}</td>
                        <td>{{ $history->percentage_input }}</td>
                        <td>{{ $history->installment_quarterly }}</td>
                        <td>{{ $history->branch_kubmetr }}</td>
                        <td>{{ $history->branch_location }}</td>
                        <td>{{ $history->branch_type }}</td>
                        <td>{{ $history->branch_name }}</td>
                        <td>{{ $history->notification_num }}</td>
                        <td>{{ $history->notification_date }}</td>
                        <td>{{ $history->insurance_policy }}</td>
                        <td>{{ $history->bank_guarantee }}</td>
                        <td>{{ $history->application_number }}</td>
                        <td>{{ $history->payed_sum }}</td>
                        <td>{{ $history->payed_date }}</td>
                        <td>{{ $history->first_payment_percent }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Address Histories -->
            <h3>Address Histories</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Event</th>
                        <th>Yuridik Address</th>
                        <th>Home Address</th>
                        <th>Company Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientHistory->addressHistories as $history)
                    <tr>
                        <td>{{ $history->user_id }}</td>
                        <td>{{ $history->event }}</td>
                        <td>{{ $history->yuridik_address }}</td>
                        <td>{{ $history->home_address }}</td>
                        <td>{{ $history->company_location }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
