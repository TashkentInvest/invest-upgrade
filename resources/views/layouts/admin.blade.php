<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('panel.site_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon_techwiz.ico') }}">
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    {{-- constructor --}}
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.css')}}">
    {{-- constructor end --}}
    

    @yield('styles')
</head>


<body data-sidebar="{{ auth()->user()->theme()['sidebar'] ?? '' }}" data-layout-mode="{{ auth()->user()->theme()['body'] ?? '' }}">

    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <style>
            @media(max-width: 757px) {
                .card-body {
                    overflow: scroll !important;
                }
            }
            .form-control {
                width: 100%;
                padding: 0.75rem !important;
                font-size: 1rem;
                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }
        </style>

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('home') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="" height="50">
                                <b>Tashkent Invest</b>
                            </span>
                        </a>


                        <a href="{{ route('home') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="" height="50">
                                <b>Tashkent Invest</b>
                            </span>

                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex">
                    <!-- Lang start -->
                
                    <!-- Lang end -->

                    <div class="dropdown d-inline-block">
                         <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            @if (session('locale') == 'uz')
                                <img id="header-lang-img" src="{{ asset('assets/images/flags/uzbekistan.jpg') }}"
                                    alt="Header Language" height="16">
                            @else
                                <img id="header-lang-img" src="{{ asset('assets/images/flags/russia.jpg') }}"
                                    alt="Header Language" height="16">
                            @endif
                        </button> 
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->

                            <a href="{{ route('changelang', 'ru') }}" class="dropdown-item notify-item language"
                                data-lang="ru">
                                <img src="{{ asset('assets/images/flags/russia.jpg') }}" alt="user-image"
                                    class="me-1" height="12"> <span class="align-middle">Русский</span>
                            </a>
                            <a href="{{ route('changelang', 'uz') }}" class="dropdown-item notify-item language"
                                data-lang="uz">
                                <img src="{{ asset('assets/images/flags/uzbekistan.jpg') }}" alt="user-image"
                                    class="me-1" height="12"> <span class="align-middle">O'zbekcha</span>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('assets/images/avatar-dafault.png') }}" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">
                                @if (auth()->user())
                                    {{ auth()->user()->name }}
                                @endif
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <!-- <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
     									 <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a> -->
                            @if (auth()->user())
                                <a class="dropdown-item d-block" href="{{ route('userEdit', auth()->user()->id) }}">
                                    <!-- <span class="badge bg-success float-end">11</span> -->
                                    <i class="bx bx-wrench font-size-16 align-middle me-1"></i>
                                    <span key="t-settings">@lang('global.settings')</span>
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item text-danger" href="#" role="button"
                                onclick="
								event.preventDefault();
								document.getElementById('logout-form').submit();">
                                <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                <span key="t-logout">@lang('global.logout')</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.sidebar')
        <!-- Left Sidebar End -->

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>Copyright &copy; {{ date('Y') }} <a href="https://t.me/#">Tashkent Invest
                                    Company</a>.</strong>
                            All rights reserved.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                <b>Version</b> 1.0
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>


    {{-- constructor --}}
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
    {{-- constructor end--}}

    <!-- JAVASCRIPT -->

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script> --}}
    <!-- Select2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/job-list.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/job-list.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- dropzone plugin -->
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
	
    {{-- <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>  --}}

    <script>
        $("#reset_form").on('click', function() {
            $('form :input').val('');
            $("form :input[class*='like-operator']").val('like');
            $("div[id*='_pair']").hide();
        });
    </script>

    <script>
        function togglePassword(inputId, toggleIconId) {
            var passwordInput = document.getElementById(inputId);
            var toggleIcon = document.getElementById(toggleIconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("mdi-eye-outline");
                toggleIcon.classList.add("mdi-eye-off-outline");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("mdi-eye-off-outline");
                toggleIcon.classList.add("mdi-eye-outline");
            }
        }
    </script>
    @if (session('_message'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: "{{ session('_type') }}",
                title: "{{ session('_message') }}",
                showConfirmButton: false,
                timer: {{ session('_timer') ?? 5000 }}
            });
        </script>
        @php(message_clear())
    @endif
    @yield('scripts')
</body>
