@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Project</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Project</h4>
                    <form>
                        <div class="row">
                            <div class="col lg-6">
                                <label for="projectname" class="col-form-label">Ruxsatnoma raqami</label>
                                    <input id="projectname" name="projectname" type="text" class="form-control"
                                        placeholder="Enter Project Name...">
                            </div>
                            <div class="col lg-6">
                                <label for="projectname" class="col-form-label">Ruxsatnoma sanasi</label>
                                    <input id="projectname" name="projectname" type="date" class="form-control"
                                        placeholder="Enter Project Name...">
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col lg-6">
                                <label for="projectname" class="col-form-label">Apz raqami</label>
                                    <input id="projectname" name="projectname" type="text" class="form-control"
                                        placeholder="Enter Project Name...">
                            </div>
                            <div class="col lg-6">
                                <label for="projectname" class="col-form-label">Apz sanasi</label>
                                    <input id="projectname" name="projectname" type="date" class="form-control"
                                        placeholder="Enter Project Name...">
                            </div>
                        </div>

                        <textarea class="w-100 my-3 form-control" name="" id="" cols="30" rows="10">Kengash xulosa</textarea>
                       
                     

                        <div class="row justify-content-end">
                            <div class="col-lg-12 my-3">
                                <button type="submit" class="btn btn-primary">Create Project</button>
                            </div>
                    </form>
                   
                   
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
