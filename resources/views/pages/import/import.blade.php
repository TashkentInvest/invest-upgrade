<!DOCTYPE html>
<html>
<head>
    <title>Import Excel Data</title>
</head>
<body>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ url('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file" required>
        <button type="submit">Import</button>
    </form>
</body>
</html>
