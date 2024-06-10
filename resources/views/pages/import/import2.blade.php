@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Transactions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('import') }}" style="color: #007bff;">Transactions</a></li>
                        <li class="breadcrumb-item active">@lang('global.add')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create New Transaction</h4>
                    
                    <form action="{{ route('import_debat.xls') }}" method="POST" enctype="multipart/form-data" id="transaction-form">
                        @csrf
                        
                        <div class="row mb-4">
                            <label for="projectname" class="col-form-label col-lg-2">Transaction Name</label>
                            <div class="col-lg-10">
                                <input id="projectname" name="projectname" type="text" class="form-control" placeholder="Enter Transaction Name...">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="projectdesc" class="col-form-label col-lg-2">Transaction Description</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="projectdesc" name="projectdesc" rows="3" placeholder="Enter Transaction Description..."></textarea>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-form-label col-lg-2">Transaction Date</label>
                            <div class="col-lg-10">
                                <div class="input-daterange input-group" id="project-date-inputgroup" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-container='#project-date-inputgroup' data-date-autoclose="true">
                                    <input type="text" class="form-control" placeholder="Start Date" name="start" />
                                    <input type="text" class="form-control" placeholder="End Date" name="end" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-form-label col-lg-2">Attached Files</label>
                            <div class="col-lg-10">
                                <div class="dropzone" id="file-dropzone">
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                        </div>
                                        <h4>Drop files here or click to upload.</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-primary">Create Transaction</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <!-- Include Dropzone CSS and JS -->


        <script>
            Dropzone.options.fileDropzone = {
                url: '{{ route('import_debat.xls') }}',
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 10,
                maxFiles: 10,
                addRemoveLinks: true,
                init: function() {
                    var myDropzone = this;
                    var form = document.getElementById('transaction-form');
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        if (myDropzone.getQueuedFiles().length > 0) {
                            myDropzone.processQueue();
                        } else {
                            form.submit();
                        }
                    });
                    myDropzone.on('sending', function(file, xhr, formData) {
                        document.querySelectorAll('#transaction-form input, #transaction-form textarea').forEach(function(input) {
                            formData.append(input.name, input.value);
                        });
                    });
                    myDropzone.on('queuecomplete', function() {
                        form.submit();
                    });
                }
            };
        </script>
    @endsection
@endsection
