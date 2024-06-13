@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Customers</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i> New Customers</button>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Phone / Email</th>
                                    <th>Address</th>
                                    <th>Rating</th>
                                    <th>Wallet Balance</th>
                                    <th>Joining Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Stephen Rash</td>
                                    <td>
                                        <p class="mb-1">325-250-1106</p>
                                        <p class="mb-0">StephenRash@teleworm.us</p>
                                    </td>

                                    <td>2470 Grove Street
                                        Bethpage, NY 11714</td>
                                    <td><span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i>
                                            4.2</span></td>
                                    <td>$5,412</td>
                                    <td>07 Oct, 2019</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="#" class="dropdown-item"><i
                                                            class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                        Edit</a></li>
                                                <li><a href="#" class="dropdown-item"><i
                                                            class="mdi mdi-trash-can font-size-16 text-danger me-1"></i>
                                                        Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination pagination-rounded justify-content-end mb-2">
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
