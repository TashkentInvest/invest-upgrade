<!DOCTYPE html>
<html>
<head>
    <title>Revisions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="px-3 mx-2">
    <h1>Revisions</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Model ID</th>
                <th>User ID / Name</th>
                <th>Field</th>
                <th>Old Value</th>
                <th>New Value</th>
                <th>Changed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($revisions as $revision)
            @php 
                $userWhich = $revision->user_id == auth()->user()->id ? auth()->user()->name  : 'n/a';
            @endphp
                <tr>
                    <td>{{ $revision->id }}</td>
                    <td>{{ class_basename($revision->revisionable_type) }}</td>
                    <td>{{ $revision->revisionable_id }}</td>
                    <td>Id: {{ $revision->user_id }} / {{$userWhich}}</td>
                    <td>{{ $revision->key }}</td>
                    <td>{{ $revision->old_value }}</td>
                    <td>{{ $revision->new_value }}</td>
                    <td>{{ $revision->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
