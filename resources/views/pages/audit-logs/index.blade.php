<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Audit Logs</h1>
        <table class="table table-bordered">
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
</body>
</html>
