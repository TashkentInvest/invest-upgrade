@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Import Excel Data</h2>


        <div class="card mt-3">
            <div class="row">
                {{-- <div class="col-12">
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
                </div> --}}
                <div class="col-6">
                    <div class="card-body">
                        <form action="{{ route('import_debat.xls') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="excel_file">Choose Excel debat File</label>
                                <input type="file" name="debat_excel_file" id="excel_file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block my-2">Import</button>
                        </form>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card-body">
                        <form action="{{ route('import_credit.xls') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="excel_file">Choose Excel credit File</label>
                                <input type="file" name="credit_excel_file" id="excel_file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block my-2">Import</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
