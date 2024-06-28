@extends('layouts.admin')

@section('content')
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Saas</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                            <li class="breadcrumb-item active">Saas</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                      
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card bg-primary bg-soft">
                                    <div>
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
                                                    <h5 class="text-primary">Добро пожаловать обратно!</h5>
                                                    <p>Панель управления Tashkent Invest</p>
                                        
                                                    <ul class="ps-3 mb-0">
                                                        <li class="py-1">Статистика компании</li>
                                                        <li class="py-1"><a target="_blank" href="https://toshkentinvest.uz/">Toshkentinvest.uz</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-copy-alt"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Orders</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4>1,452 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                                    <div class="d-flex">
                                                        <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span class="ms-2 text-truncate">From previous period</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-archive-in"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Revenue</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4>$ 28,452 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                                    <div class="d-flex">
                                                        <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span class="ms-2 text-truncate">From previous period</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-purchase-tag-alt"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-14 mb-0">Average Price</h5>
                                                </div>
                                                <div class="text-muted mt-4">
                                                    <h4>$ 16.2 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                                    
                                                    <div class="d-flex">
                                                        <span class="badge badge-soft-warning font-size-12"> 0% </span> <span class="ms-2 text-truncate">From previous period</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>

                        <div class="row">
                           

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Sales Analytics</h4>

                                        <div>
                                            <div id="donut-chart" data-colors='["--bs-primary", "--bs-success", "--bs-danger"]' class="apex-charts"></div>
                                        </div>

                                        <div class="text-center text-muted">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mt-4">
                                                        <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary me-1"></i> Product A</p>
                                                        <h5>$ 2,132</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mt-4">
                                                        <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success me-1"></i> Product B</p>
                                                        <h5>$ 1,763</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mt-4">
                                                        <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-danger me-1"></i> Product C</p>
                                                        <h5>$ 973</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                     

                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 col-9">
                                                <h5 class="font-size-15 mb-1">Steven Franklin</h5>
                                                <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                                            </div>
                                            <div class="col-md-8 col-3">
                                                <ul class="list-inline user-chat-nav text-end mb-0">
                                                    <li class="list-inline-item d-none d-sm-inline-block">
                                                        <div class="dropdown">
                                                            <button class="btn nav-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-search-alt-2"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end py-0 dropdown-menu-md">
                                                                <form class="p-3">
                                                                    <div class="form-group m-0">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                            
                                                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item  d-none d-sm-inline-block">
                                                        <div class="dropdown">
                                                            <button class="btn nav-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-cog"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">View Profile</a>
                                                                <a class="dropdown-item" href="#">Clear chat</a>
                                                                <a class="dropdown-item" href="#">Muted</a>
                                                                <a class="dropdown-item" href="#">Delete</a>
                                                            </div>
                                                        </div>
                                                    </li>
    
                                                    <li class="list-inline-item">
                                                        <div class="dropdown">
                                                            <button class="btn nav-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div>
                                            <div class="chat-conversation">
                                                <ul class="list-unstyled" data-simplebar style="max-height: 260px;">
                                                    <li> 
                                                        <div class="chat-day-title">
                                                            <span class="title">Today</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="conversation-list">
                                                            <div class="dropdown">
        
                                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                  </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#">Copy</a>
                                                                    <a class="dropdown-item" href="#">Save</a>
                                                                    <a class="dropdown-item" href="#">Forward</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <div class="ctext-wrap">
                                                                <div class="conversation-name">Steven Franklin</div>
                                                                <p>
                                                                    Hello!
                                                                </p>
                                                                <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:00</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </li>
        
                                                    <li class="right">
                                                        <div class="conversation-list">
                                                            <div class="dropdown">
        
                                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                  </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#">Copy</a>
                                                                    <a class="dropdown-item" href="#">Save</a>
                                                                    <a class="dropdown-item" href="#">Forward</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <div class="ctext-wrap">
                                                                <div class="conversation-name">Henry Wells</div>
                                                                <p>
                                                                    Hi, How are you? What about our next meeting?
                                                                </p>
        
                                                                <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                                            </div>
                                                        </div>
                                                    </li>
        
                                                    <li>
                                                        <div class="conversation-list">
                                                            <div class="dropdown">
        
                                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                  </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#">Copy</a>
                                                                    <a class="dropdown-item" href="#">Save</a>
                                                                    <a class="dropdown-item" href="#">Forward</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <div class="ctext-wrap">
                                                                <div class="conversation-name">Steven Franklin</div>
                                                                <p>
                                                                    Yeah everything is fine
                                                                </p>
                                                                
                                                                <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </li>
        
                                                    <li class="last-chat">
                                                        <div class="conversation-list">
                                                            <div class="dropdown">
        
                                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                  </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#">Copy</a>
                                                                    <a class="dropdown-item" href="#">Save</a>
                                                                    <a class="dropdown-item" href="#">Forward</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <div class="ctext-wrap">
                                                                <div class="conversation-name">Steven Franklin</div>
                                                                <p>& Next meeting tomorrow 10.00AM</p>
                                                                <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </li>
        
                                                    <li class="right">
                                                        <div class="conversation-list">
                                                            <div class="dropdown">
        
                                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                  </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#">Copy</a>
                                                                    <a class="dropdown-item" href="#">Save</a>
                                                                    <a class="dropdown-item" href="#">Forward</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <div class="ctext-wrap">
                                                                <div class="conversation-name">Henry Wells</div>
                                                                <p>
                                                                    Wow that's great
                                                                </p>
        
                                                                <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:07</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    
                                                    
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="p-3 chat-input-section">
                                        <div class="row">
                                            <div class="col">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control rounded chat-input" placeholder="Enter Message...">
                                                    <div class="chat-input-links">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item"><a href="javascript: void(0);"><i class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                                            <li class="list-inline-item"><a href="javascript: void(0);"><i class="mdi mdi-file-image-outline"></i></a></li>
                                                            <li class="list-inline-item"><a href="javascript: void(0);"><i class="mdi mdi-file-document-outline"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <!-- end row -->
@endsection
@section('scripts')

        <!-- apexcharts -->
        <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
        
        <!-- Saas dashboard init -->
        <script src="{{asset('assets/js/pages/saas-dashboard.init.js')}}"></script>


@endsection