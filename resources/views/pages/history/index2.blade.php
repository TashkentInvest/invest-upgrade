<!-- resources/views/pages/history/index2.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Client Histories</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact</th>
                <th>company</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientHistories as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->first_name }}</td>
                <td>{{ $client->last_name }}</td>
                <td>{{ $client->contact }}</td> 
                <td>{{ $client->company->company_name }}</td> 
                <td><a href="{{ route('history.show', $client->id) }}" class="btn btn-primary">View Details</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clientHistories->links() }}
</div>
@endsection
