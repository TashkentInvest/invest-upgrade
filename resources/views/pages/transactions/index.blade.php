@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Transactions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}"
                                style="color: #007bff;">Transactions</a></li>
                        <li class="breadcrumb-item active">@lang('global.add')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Transactions Lists</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('import') }}" class="btn btn-primary">Import Exel</a>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-lg-6">
                            <input type="search" class="form-control" id="searchInput" placeholder="Search for ...">
                        </div>
                        <div class="col-xxl-2 col-lg-6">
                            <select class="form-control select2">
                                <option>Status</option>
                                <option value="Active">Active</option>
                                <option value="New">New</option>
                                <option value="Close">Close</option>
                            </select>
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <select class="form-control select2">
                                <option>Select Type</option>
                                <option value="1">Full Time</option>
                                <option value="2">Part Time</option>
                            </select>
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <div id="datepicker1">
                                <input type="text" class="form-control" placeholder="Select date"
                                    data-date-format="dd M, yyyy" data-date-autoclose="true"
                                    data-date-container='#datepicker1' data-provide="datepicker">
                            </div><!-- input-group -->
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <button type="button" class="btn btn-soft-secondary w-100"><i
                                    class="mdi mdi-filter-outline align-middle"></i> Filter</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Posted Date</th>
                                    <th scope="col">Last Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Magento Developer</td>
                                    <td>Themesbrand</td>
                                    <td>California</td>
                                    <td>0-2 Years</td>
                                    <td>2</td>
                                    <td><span class="badge badge-soft-success">Full Time</span></td>
                                    <td>02 June 2021</td>
                                    <td>25 June 2021</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="job-details.html" class="btn btn-sm btn-soft-primary"><i
                                                        class="mdi mdi-eye-outline"></i></a>
                                            </li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <a href="#" class="btn btn-sm btn-soft-info"><i
                                                        class="mdi mdi-pencil-outline"></i></a>
                                            </li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                <a href="#jobDelete" data-bs-toggle="modal"
                                                    class="btn btn-sm btn-soft-danger"><i
                                                        class="mdi mdi-delete-outline"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!--end row-->
                </div>
            </div><!--end card-->
        </div><!--end col-->

    </div><!--end row-->
@endsection
