@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Import Excel Data</h2>
        
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mt-3">
            <div class="card-body">
                <form action="{{ route('import.xls') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excel_file">Choose Excel File</label>
                        <input type="file" name="excel_file" id="excel_file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block my-2">Import</button>
                </form>
            </div>
        </div>
    </div>
@endsection
