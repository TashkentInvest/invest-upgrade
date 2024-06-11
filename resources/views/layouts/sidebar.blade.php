<!-- Left sidebar -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('cruds.menu_top.menu')</li>
                <!-- Branches -->
                <li class="{{ Request::is('product*') ? 'mm-active' : '' }}">
                    <a href="{{ route('clientIndex') }}"
                        class=" waves-effect {{ Request::is('product*') ? 'mm-active' : '' }}">
                        <i class="bx bx-map-alt"></i>
                        <span>@lang('cruds.branches.title')</span>
                    </a>
                </li>

                {{-- Audit logs --}}
                @can('audit.show')
                    <li class="{{ Request::is('audit-logs*') ? 'mm-active' : '' }}">
                        <a href="{{ route('audit-logs.index') }}"
                            class=" waves-effect {{ Request::is('audit-logs*') ? 'mm-active' : '' }}">
                            <i class="bx bx-info-circle"></i>
                            <span>Audit Logs</span>
                        </a>
                    </li>
                @endcan


                @can('backup.show')
                    <li class="{{ Request::is('backup*') ? 'mm-active' : '' }}">
                        <a href="{{ route('backup.index') }}"
                            class=" waves-effect {{ Request::is('backup*') ? 'mm-active' : '' }}">
                            <i class="bx bx-data"></i>
                            <span>Backup</span>
                        </a>
                    </li>
                @endcan

                @can('user.show')
                    <li
                        class="{{ Request::is('permission*') || Request::is('role*') || Request::is('user*') || Request::is('client*') ? 'mm-active' : '' }}">
                        <a href="javascript: void(0);"
                            class="has-arrow waves-effect {{ Request::is('permission*') || Request::is('role*') || Request::is('user*') || Request::is('client*') ? 'mm-active' : '' }}">
                            <i class="fas fa-users-cog"></i>
                            <span>@lang('cruds.userManagement.title')</span>
                        </a>
                        <ul class="sub-menu {{ Request::is('permission*') || Request::is('role*') || Request::is('user*') || Request::is('client*') ? ' ' : 'd-none' }}"
                            aria-expanded="false">
                            @can('permission.show')
                                <li>
                                    <a href="{{ route('permissionIndex') }}"
                                        class="{{ Request::is('permission*') ? 'mm-active' : '' }}">
                                        <i class="bx bxs-key" style="font-size: 14px; min-width: auto;"></i>
                                        @lang('cruds.permission.title_singular')
                                    </a>
                                </li>
                            @endcan
                            @can('roles.show')
                                <li>
                                    <a href="{{ route('roleIndex') }}" class="{{ Request::is('role*') ? 'mm-active' : '' }}">

                                        <i class="bx bxs-lock-alt" style="font-size: 14px; min-width: auto;"></i>
                                        @lang('cruds.role.fields.roles')
                                    </a>
                                </li>
                            @endcan
                            @can('user.show')
                                <li>
                                    <a href="{{ route('userIndex') }}" class="{{ Request::is('user*') ? 'mm-active' : '' }}">
                                        <!-- <i class="fas fa-user-friends"></i> -->
                                        <i class="bx bxs-user-plus" style="font-size: 14px; min-width: auto;"></i>
                                        @lang('cruds.user.title')
                                    </a>
                                </li>
                            @endcan

                            {{-- @can('user.show')
                                <li>
                                    <a href="{{ route('clientIndex') }}" class="{{ Request::is('client*') ? 'mm-active':'' }}">
                                        <!-- <i class="fas fa-user-friends"></i> -->
                                        <i class="bx bxs-user-plus" style="font-size: 14px; min-width: auto;"></i>
                                        @lang('cruds.client.title')
                                    </a>
                                </li>
                            @endcan --}}
                        </ul>
                    </li>
                @endcan

                @can('transaction.show')
                    <li class="{{ Request::is('import*') || Request::is('transactions*') ? 'mm-active' : '' }}">
                        <a href="javascript: void(0);"
                            class="has-arrow waves-effect {{ Request::is('import*') || Request::is('transactions*') ? 'mm-active' : '' }}">
                            <i class="bx bx-file"></i>

                            <span>Transactions</span>
                        </a>
                        <ul class="sub-menu {{ Request::is('import*') || Request::is('transactions*') ? ' ' : 'd-none' }}"
                            aria-expanded="false">
                            @can('import.show')
                                <li>
                                    <a href="{{ route('import') }}" class="{{ Request::is('import*') ? 'mm-active' : '' }}">
                                        <i class="bx bx-import" style="font-size: 14px; min-width: auto;"></i>

                                        Import
                                    </a>
                                </li>
                            @endcan

                            @can('import.show')
                                <li>
                                    <a href="{{ route('transactions.index') }}"
                                        class="{{ Request::is('transaction*') ? 'mm-active' : '' }}">
                                        <i class="bx bxs-bar-chart-square" style="font-size: 14px; min-width: auto;"></i>
                                        View
                                    </a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                @endcan

                <li class="menu-title">@lang('global.theme')</li>
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-palette"></i>
                        <span>@lang('global.theme')</span>
                    </a>
                    <ul class="sub-menu d-none" aria-expanded="false">
                        <li>
                            <a href="{{ route('userSetTheme', [auth()->id(), 'theme' => 'default']) }}">
                                <!-- <i class="fas fa-key"></i> -->
                                <i class="nav-icon fas fa-circle text-info"></i>
                                Default {{ auth()->user()->theme == 'default' ? '✅' : '' }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('userSetTheme', [auth()->id(), 'theme' => 'light']) }}">
                                <!-- <i class="fas fa-key"></i> -->
                                <i class="nav-icon fas fa-circle text-white"></i>
                                Light {{ auth()->user()->theme == 'light' ? '✅' : '' }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('userSetTheme', [auth()->id(), 'theme' => 'dark']) }}">
                                <!-- <i class="fas fa-key"></i> -->
                                <i class="nav-icon fas fa-circle text-gray"></i>
                                Dark {{ auth()->user()->theme == 'dark' ? '✅' : '' }}
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- regions and districts start -->
                {{-- <li class="{{ (Request::is('region*') || Request::is('district*') ) ? 'mm-active':''}}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ (Request::is('region*') || Request::is('district*') ) ? 'mm-active':''}}">
                        <i class="fas fa-globe-asia"></i>
                        <span>@lang('cruds.regions_districts.title')</span>
                    </a>
                    <ul class="sub-menu {{ (Request::is('region*') || Request::is('district*') ) ? ' ':'d-none'}}" aria-expanded="false">
                        <li>
                            <a href="{{ route('regionIndex') }}" class="{{ Request::is('region*') ? 'mm-active':'' }}">
                                <!-- <i class="fas fa-globe-asia" style="font-size: 14px; min-width: auto;"></i> -->
                                @lang('cruds.regions_districts.regions.title')
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('districtIndex') }}" class="{{ Request::is('district*') ? 'mm-active':'' }}">
                                <!-- <i class="fas fa-globe-asia" style="font-size: 14px; min-width: auto;"></i> -->
                                @lang('cruds.regions_districts.districts.title')
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <!-- regions and districts end -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
