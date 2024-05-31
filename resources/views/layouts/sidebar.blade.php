<!-- Left sidebar -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('cruds.menu_top.menu')</li>
                <!-- Branches -->
                <li class="{{ Request::is('product*') ? 'mm-active':'' }}">
                    <a href="{{ route('productIndex') }}" class=" waves-effect {{ Request::is('product*') ? 'mm-active':'' }}">
                        <i class="bx bx-map-alt"></i>
                        <span>@lang('cruds.branches.title')</span>
                    </a>
                </li>

                {{-- Audit logs --}}

                <li class="{{ Request::is('audit-logs*') ? 'mm-active':'' }}">
                    <a href="{{ route('audit-logs.index') }}" class=" waves-effect {{ Request::is('audit-logs*') ? 'mm-active':'' }}">
                        <i class="bx bx-info-circle"></i>
                        <span>Audit Logs</span>
                    </a>
                </li>

{{--                 
                <li class="{{ Request::is('audit-logs*') ? 'mm-active':'' }}">
                    <a href="/doc" class=" waves-effect {{ Request::is('audit-logs*') ? 'mm-active':'' }}">
                        <i class="bx bx-info-circle"></i>
                        <span>Word</span>
                    </a>
                </li>
          --}}

                <!-- Category -->
             
                <!-- Category -->
             

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

                <!-- other menu -->
                {{-- @can('api-user.view')
                <li class="menu-title">@lang('cruds.menu_top.api_users')</li>
                <li class="{{ Request::is('api-user*') ? 'mm-active':'' }}">
                    <a href="{{ route('api-userIndex') }}" class=" waves-effect {{ Request::is('api-users*') ? 'mm-active':'' }}">
                        <i class="fas fa-cog"></i>
                        <!-- <sub><i class="fas fa-child"></i></sub> -->
                        <span>@lang('cruds.menu_top.api_users')</span>
                    </a>
                </li>
                @endcan --}}

                @can('user.show')
                <li class="{{ (Request::is('permission*') || Request::is('role*') || Request::is('user*') || Request::is('client*')) ? 'mm-active':''}}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*') || Request::is('client*')) ? 'mm-active':''}}">
                        <i class="fas fa-users-cog"></i>
                        <span>@lang('cruds.userManagement.title')</span>
                    </a>
                    <ul class="sub-menu {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*') || Request::is('client*')) ? ' ':'d-none'}}" aria-expanded="false">
                        @can('permission.show')
                            <li>
                                <a href="{{ route('permissionIndex') }}" class="{{ Request::is('permission*') ? 'mm-active':'' }}">
                                    <i class="bx bxs-key" style="font-size: 14px; min-width: auto;"></i>
                                    @lang('cruds.permission.title_singular')
                                </a>
                            </li>
                        @endcan
                        @can('roles.show')
                            <li>
                                <a href="{{ route('roleIndex') }}" class="{{ Request::is('role*') ? 'mm-active':'' }}">
                                    
                                    <i class="bx bxs-lock-alt" style="font-size: 14px; min-width: auto;"></i>
                                    @lang('cruds.role.fields.roles')
                                </a>
                            </li>
                        @endcan
                        @can('user.show')
                            <li>
                                <a href="{{ route('userIndex') }}" class="{{ Request::is('user*') ? 'mm-active':'' }}">
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

                <li class="menu-title">@lang('global.theme')</li>
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-palette"></i>
                        <span>@lang('global.theme')</span>
                    </a>
                    <ul class="sub-menu d-none" aria-expanded="false">
                        <li>
                            <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'default']) }}">
                                <!-- <i class="fas fa-key"></i> -->
                                <i class="nav-icon fas fa-circle text-info"></i>
                                Default {{ auth()->user()->theme == 'default' ? '✅':'' }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'light']) }}">
                                <!-- <i class="fas fa-key"></i> -->
                                <i class="nav-icon fas fa-circle text-white"></i>
                                Light {{ auth()->user()->theme == 'light' ? '✅':'' }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'dark']) }}">
                                <!-- <i class="fas fa-key"></i> -->
                                <i class="nav-icon fas fa-circle text-gray"></i>
                                Dark {{ auth()->user()->theme == 'dark' ? '✅':'' }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>