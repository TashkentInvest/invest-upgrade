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

                                        <div class="apex-charts" id="radial-chart" data-colors="[&quot;--bs-primary&quot;]" style="min-height: 66px;">
                                            <div id="apexchartss7urv6zhh" class="apexcharts-canvas apexchartss7urv6zhh apexcharts-theme-light" style="width: 190px; height: 66px;"></div>
                                        </div>
                                
                                        {{-- <p class="text-muted mt-4">48.02 GB (76%) of 64 GB used</p> --}}
                                        <p class="text-muted mt-4">Total Storage Size: {{ $totalSizeFormatted }} bytes</p>

                                        
                                        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

                                        <script>
                                            // Assign total size from PHP to JavaScript variable
                                            var totalSize = "{{ $totalSizeFormatted }}";
                                        
                                            // Remove any non-numeric characters and convert to a number
                                            totalSize = parseFloat(totalSize.replace(/[^0-9.]/g, ''));
                                        
                                            // Sample ApexCharts options
                                            var options = {
                                                series: [totalSize], // Use the totalSize variable here
                                                chart: {
                                                    type: 'radialBar',
                                                    height: 200,
                                                },
                                                plotOptions: {
                                                    radialBar: {
                                                        hollow: {
                                                            size: '50%',
                                                        },
                                                        dataLabels: {
                                                            showOn: 'always',
                                                            name: {
                                                                offsetY: -10,
                                                                show: true,
                                                                color: '#888',
                                                                fontSize: '13px',
                                                            },
                                                            value: {
                                                                color: '#111',
                                                                fontSize: '16px',
                                                                formatter: function (val) {
                                                                    return val + '%';
                                                                }
                                                            }
                                                        }
                                                    }
                                                },
                                                fill: {
                                                    colors: ['#2196F3'],
                                                },
                                                labels: ['Storage'],
                                            };
                                        
                                            // Initialize ApexCharts
                                            var chart = new ApexCharts(document.querySelector("#apexchartss7urv6zhh"), options);
                                            chart.render();
                                        </script>
                                        
                                        
                                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 191px; height: 53px;"></div></div><div class="contract-trigger"></div></div></div>
                                </li>
                               
                                <li>
                                    <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                        <i class="mdi mdi-trash-can text-danger font-size-16 me-2"></i> <span class="me-auto">Trash</span>
                                    </a>
                                </li>
                              
                            </ul>
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
                                <h5 class="font-size-16 me-3">Backup Files</h5>

                            
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
                                        @foreach ($backupDetails as $backup)
                                   
                                            <tr>
                                                <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-text-box font-size-16 align-middle text-muted me-2"></i> {{ basename($backup['file']) }}</a></td>
                                                {{-- <td>09-10-2020, 17:05</td> --}}

                                                <td>{{ date('Y-m-d H:i:s', $backup['creation_date']) }}</td>

                                                <td>{{round($backup['size'] / 1024, 2) }} KB</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
                                                        
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                    
                                                            <a class="dropdown-item" href="{{ route('backup.download', basename($backup['file'])) }}">Downlaod</a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('backup.delete', basename($backup['file'])) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item" >Remove</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                      
                                        @endforeach
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
