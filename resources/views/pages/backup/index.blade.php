@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Backups</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">Backups</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="d-xl-flex">
    <div class="w-100">
        <div class="d-md-flex">
            <div class="card filemanager-sidebar me-md-2">
                <div class="card-body">

                    <div class="d-flex flex-column h-100">
                        <div class="mb-4">
                           
                            <ul class="list-unstyled categories-list">
                                <li>
                                    <div class="text-center" style="position: relative;">
                                        <h5 class="font-size-15 mb-4">Storage</h5>
                                        <div class="apex-charts" id="radial-chart" data-colors="[&quot;--bs-primary&quot;]" style="min-height: 66px;"><div id="apexchartss7urv6zhh" class="apexcharts-canvas apexchartss7urv6zhh apexcharts-theme-light" style="width: 190px; height: 66px;"><svg id="SvgjsSvg1025" width="190" height="66" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1027" class="apexcharts-inner apexcharts-graphical" transform="translate(20, -10)"><defs id="SvgjsDefs1026"><clipPath id="gridRectMasks7urv6zhh"><rect id="SvgjsRect1029" width="156" height="162" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMasks7urv6zhh"><rect id="SvgjsRect1030" width="154" height="164" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1031" class="apexcharts-radialbar"><g id="SvgjsG1032"><g id="SvgjsG1033" class="apexcharts-tracks"><g id="SvgjsG1034" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 21.280487804878042 75 A 53.71951219512196 53.71951219512196 0 0 1 128.71951219512195 75" fill="none" fill-opacity="1" stroke="rgba(231,231,231,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="9.345121951219513" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathorig="M 21.280487804878042 75 A 53.71951219512196 53.71951219512196 0 0 1 128.71951219512195 75"></path></g></g><g id="SvgjsG1036"><g id="SvgjsG1040" class="apexcharts-series apexcharts-radial-series" seriesname="Storage" rel="1" data:realindex="0"><path id="SvgjsPath1041" d="M 21.280487804878042 75 A 53.71951219512196 53.71951219512196 0 0 1 114.28796409307861 38.36338077956944" fill="none" fill-opacity="0.85" stroke="rgba(85,110,230,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="9.634146341463415" stroke-dasharray="3" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="137" data:value="76" index="0" j="0" data:pathorig="M 21.280487804878042 75 A 53.71951219512196 53.71951219512196 0 0 1 114.28796409307861 38.36338077956944"></path></g><circle id="SvgjsCircle1037" r="44.0469512195122" cx="75" cy="75" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1038" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1039" font-family="Helvetica, Arial, sans-serif" x="75" y="73" text-anchor="middle" dominant-baseline="auto" font-size="16px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Helvetica, Arial, sans-serif;">76%</text></g></g></g></g><line id="SvgjsLine1042" x1="0" y1="0" x2="150" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1043" x1="0" y1="0" x2="150" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1028" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                        
                                        <p class="text-muted mt-4">48.02 GB (76%) of 64 GB used</p>
                                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 191px; height: 53px;"></div></div><div class="contract-trigger"></div></div></div>
                                </li>
                               
                                <li>
                                    <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                        <i class="mdi mdi-trash-can text-danger font-size-16 me-2"></i> <span class="me-auto">Trash</span>
                                    </a>
                                </li>
                              
                            </ul>
                        </div>

                        <div class="mt-auto">
                            <div class="alert alert-success alert-dismissible fade show px-3 mb-0" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="mb-3">
                                    <i class="bx bxs-folder-open h1 text-success"></i>
                                </div>

                                <div>
                                    <h5 class="text-success">Upgrade Features</h5>
                                    <p>Cum sociis natoque penatibus et</p>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-link text-decoration-none text-success">Upgrade <i class="mdi mdi-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                </div>
            </div>
            <!-- filemanager-leftsidebar -->

            <div class="w-100">
                <div class="card">
                    <div class="card-body">

                        <div class="mt-4">
                            <div class="d-flex flex-wrap">
                                <h5 class="font-size-16 me-3">Recent Files</h5>

                                <div class="ms-auto">
                                    <a href="javascript: void(0);" class="fw-medium text-reset">View All</a>
                                </div>
                            </div>
                            <hr class="mt-2">

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                          <th scope="col">Name</th>
                                          <th scope="col">Date modified</th>
                                          <th scope="col" colspan="2">Size</th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-file-document font-size-16 align-middle text-primary me-2"></i> index.html</a></td>
                                            <td>12-10-2020, 09:45</td>
                                            <td>09 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder-zip font-size-16 align-middle text-warning me-2"></i> Project-A.zip</a></td>
                                            <td>11-10-2020, 17:05</td>
                                            <td>115 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-image font-size-16 align-middle text-muted me-2"></i> Img-1.jpeg</a></td>
                                            <td>11-10-2020, 13:26</td>
                                            <td>86 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-text-box font-size-16 align-middle text-muted me-2"></i> update list.txt</a></td>
                                            <td>10-10-2020, 11:32</td>
                                            <td>08 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder font-size-16 align-middle text-warning me-2"></i> Project B</a></td>
                                            <td>10-10-2020, 10:51</td>
                                            <td>72 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-text-box font-size-16 align-middle text-muted me-2"></i> Changes list.txt</a></td>
                                            <td>09-10-2020, 17:05</td>
                                            <td>07 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-image font-size-16 align-middle text-success me-2"></i> Img-2.png</a></td>
                                            <td>09-10-2020, 15:12</td>
                                            <td>31 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder font-size-16 align-middle text-warning me-2"></i> Project C</a></td>
                                            <td>09-10-2020, 10:11</td>
                                            <td>20 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="bx bxs-file font-size-16 align-middle text-primary me-2"></i> starter-page.html</a></td>
                                            <td>08-10-2020, 03:22</td>
                                            <td>11 KB</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Open</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Rename</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end w-100 -->
        </div>
    </div>

  
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Backups</h3>
            </div>
            <div class="card-body">
              
                {{-- <table class="table">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Size (KB)</th>
                            <th>Creation Date</th>
                            <th>Line Count</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backupDetails as $backup)
                        <tr>
                            <td>{{ basename($backup['file']) }}</td>
                            <td>{{ round($backup['size'] / 1024, 2) }}</td>
                            <td>{{ date('Y-m-d H:i:s', $backup['creation_date']) }}</td>
                            <td>{{ $backup['line_count'] }}</td>
                            <td class="d-flex">
                                <form action="{{ route('backup.download', basename($backup['file'])) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </form>
                                <form action="{{ route('backup.delete', basename($backup['file'])) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "order": [[ 4, "desc" ]], // Order by the Timestamp column by default
            "pageLength": 10, // Show 10 entries per page by default
        });
    });
</script>
@endpush
