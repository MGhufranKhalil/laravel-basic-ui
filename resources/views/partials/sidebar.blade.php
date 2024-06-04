<div class="sidebar">
    <div class="sidebar-header">
        <a href="#" class=""><img src="{{ asset('asset/img/logo-1.png') }}" width="140px" height="100%" /></a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">Dashboard</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="#" class="nav-link active"><i class="ri-suitcase-2-fill"></i>
                        <span>Dashboard</span></a>
                </li>
            </ul>
        </div><!-- nav-group -->
        <div class="nav-group show">
            <ul class="nav nav-sidebar">
                @if (auth()->user()->hasRole('super-admin') && auth()->user()->company_id == 0)
                    <li class="nav-item ">
                        <a href="" class="nav-link has-sub @if (Route::is('company.*') || Route::is('company')) active @endif"><i class="ri-account-circle-line"></i>
                            <span>Company</span></a>
                        <nav class="nav nav-sub" @if (Route::is('company.*') || Route::is('company')) style="display: block" @endif>
                            <a href="{{route('company')}}" class="nav-sub-link @if (Route::is('company')) active @endif">All</a>
                            <a href="{{route('company.create')}}" class="nav-sub-link  @if (Route::is('company.create')) active @endif">Create</a>
                        </nav>
                    </li>
                @endif

                <li class="nav-item ">
                    <a href="" class="nav-link has-sub @if (Route::is('employee.*') || Route::is('employee')) active @endif"><i class="ri-account-circle-line"></i>
                        <span>Employees</span></a>
                    <nav class="nav nav-sub" @if (Route::is('employee.*') || Route::is('employee')) style="display: block" @endif>
                        <a href="{{route('employee')}}" class="nav-sub-link @if (Route::is('employee')) active @endif">All</a>
                        <a href="{{route('employee.create')}}" class="nav-sub-link  @if (Route::is('employee.create')) active @endif">Create</a>
                    </nav>
                </li>
                 
                <li class="nav-item ">
                    <a href="" class="nav-link has-sub @if (Route::is('incident.*') || Route::is('incident')) active @endif"><i class="ri-account-circle-line"></i>
                        <span>Incident</span></a>
                    <nav class="nav nav-sub" @if (Route::is('incident.*') || Route::is('incident')) style="display: block" @endif>
                        <a href="{{route('incident')}}" class="nav-sub-link @if (Route::is('incident')) active @endif">All</a>
                        <a href="{{route('incident.create')}}" class="nav-sub-link  @if (Route::is('incident.create')) active @endif">Create</a>
                    </nav>
                </li>

                <li class="nav-item ">
                    <a href="" class="nav-link has-sub @if (Route::is('user.*') || Route::is('user')) active @endif"><i class="ri-account-circle-line"></i>
                        <span>Users</span></a>
                    <nav class="nav nav-sub" @if (Route::is('user.*') || Route::is('user')) style="display: block" @endif>
                        <a href="{{route('user')}}" class="nav-sub-link @if (Route::is('user')) active @endif">All</a>
                        <a href="{{route('user.create')}}" class="nav-sub-link  @if (Route::is('user.create')) active @endif">Create</a>
                    </nav>
                </li>

                <li class="nav-item ">
                    <a href="" class="nav-link has-sub @if (Route::is('role.*') || Route::is('role')) active @endif"><i class="ri-account-circle-line"></i>
                        <span>Roles</span></a>
                    <nav class="nav nav-sub" @if (Route::is('role.*') || Route::is('role')) style="display: block" @endif>
                        <a href="{{route('role')}}" class="nav-sub-link @if (Route::is('role')) active @endif">All</a>
                        <a href="{{route('role.create')}}" class="nav-sub-link  @if (Route::is('role.create')) active @endif">Create</a>
                    </nav>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-account-circle-line"></i>
                        <span>Options</span></a>
                    <nav class="nav nav-sub">
                        <a href="{{route('option')}}" class="nav-sub-link">All</a>
                        <a href="{{route('option.create')}}" class="nav-sub-link">Create</a>
                    </nav>
                </li>

                
            </ul>
        </div>
    </div><!-- sidebar-body -->
</div><!-- sidebar -->
