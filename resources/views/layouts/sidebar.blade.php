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
                <!-- Branches -->

                    <!-- Branches -->
                <li class="{{ Request::is('blog*') ? 'mm-active':'' }}">
                    <a href="{{ route('blogIndex') }}" class=" waves-effect {{ Request::is('blog*') ? 'mm-active':'' }}">
                        <i class="bx bx-map-alt"></i>
                        <span>@lang('cruds.blogs.title')</span>
                    </a>
                </li>
                <!-- Branches -->

                <!-- Category -->
                <li class="{{ (Request::is('categories*') || Request::is('category*') ) ? 'mm-active':'' }}">
                    <a href="{{ route('categoryIndex') }}" class=" waves-effect {{ (Request::is('categories*') || Request::is('category*') ) ? 'mm-active':'' }}">
                        <i class="bx bx-border-all"></i>
                        <span>@lang('cruds.category.title')</span>
                    </a>
                </li>
                <!-- Category -->
                
                <!-- jobs menu started -->
                <li class="{{ (Request::is('job*') ) ? 'mm-active':''}}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ (Request::is('job*') ) ? 'mm-active':''}}">
                        <i class="bx bx-briefcase-alt"></i>
                        <span>@lang('cruds.job.title')</span>
                    </a>
                    <ul class="sub-menu {{ (Request::is('job*') ) ? ' ':'d-none'}}" aria-expanded="false">
                        <li>
                            <a href="{{ route('jobProgramIndex') }}" class="{{ Request::is('job-program*') ? 'mm-active':'' }}">
                                <!-- <i class="fas fa-globe-asia" style="font-size: 14px; min-width: auto;"></i> -->
                                @lang('cruds.job.programs')
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- jobs menu end -->

                <!-- regions and districts start -->
                <li class="{{ (Request::is('region*') || Request::is('district*') ) ? 'mm-active':''}}">
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
                </li>
                <!-- regions and districts end -->

                <!-- settings start -->
                <li class="{{ (Request::is('setting*') ) ? 'mm-active':''}}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ (Request::is('setting*') ) ? 'mm-active':''}}">
                        <i class="fas fa-cog"></i>
                        <span>@lang('cruds.setting.title')</span>
                    </a>
                    <ul class="sub-menu {{ (Request::is('setting*') ) ? ' ':'d-none'}}" aria-expanded="false">
                        <li>
                            <a href="{{ route('settingStartMessage') }}" class="{{ Request::is('setting/start/message*') ? 'mm-active':'' }}">
                                <!-- <i class="bx bx-text" style="font-size: 14px; min-width: auto;"></i> -->
                                @lang('cruds.setting.text_bot')
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('settingAbout') }}" class="{{ Request::is('setting/about*') ? 'mm-active':'' }}">
                                <!-- <i class="bx bxs-building" style="font-size: 14px; min-width: auto;"></i> -->
                                @lang('cruds.setting.about_company')
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- settings end -->

                <!-- other menu -->
                @can('api-user.view')
                <li class="menu-title">@lang('cruds.menu_top.api_users')</li>
                <li class="{{ Request::is('api-user*') ? 'mm-active':'' }}">
                    <a href="{{ route('api-userIndex') }}" class=" waves-effect {{ Request::is('api-users*') ? 'mm-active':'' }}">
                        <i class="fas fa-cog"></i>
                        <!-- <sub><i class="fas fa-child"></i></sub> -->
                        <span>@lang('cruds.menu_top.api_users')</span>
                    </a>
                </li>
                @endcan

                @can('api-user.view')
                <li class="{{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'mm-active':''}}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'mm-active':''}}">
                        <i class="fas fa-users-cog"></i>
                        <span>@lang('cruds.userManagement.title')</span>
                    </a>
                    <ul class="sub-menu {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? ' ':'d-none'}}" aria-expanded="false">
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