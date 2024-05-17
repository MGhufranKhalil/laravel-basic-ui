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
                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-account-circle-line"></i>
                        <span>Company</span></a>
                    <nav class="nav nav-sub">
                        <a href="{{ route('company')}}" class="nav-sub-link">All</a>
                        <a href="{{route('company.create')}}" class="nav-sub-link">Create</a>
                    </nav>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-account-circle-line"></i>
                        <span>Employees</span></a>
                    <nav class="nav nav-sub">
                        <a href="{{route('employee')}}" class="nav-sub-link">All</a>
                        <a href="{{route('employee.create')}}" class="nav-sub-link">Create</a>
                    </nav>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-account-circle-line"></i>
                        <span>Incident</span></a>
                    <nav class="nav nav-sub">
                        <a href="{{route('incident')}}" class="nav-sub-link">All</a>
                        <a href="{{route('incident.create')}}" class="nav-sub-link">Create</a>
                    </nav>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-account-circle-line"></i>
                        <span>Users</span></a>
                    <nav class="nav nav-sub">
                        <a href="{{route('user')}}" class="nav-sub-link">All</a>
                        <a href="{{route('user.create')}}" class="nav-sub-link">Create</a>
                    </nav>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-account-circle-line"></i>
                        <span>Roles</span></a>
                    <nav class="nav nav-sub">
                        <a href="{{route('role')}}" class="nav-sub-link">All</a>
                        <a href="{{route('role.create')}}" class="nav-sub-link">Create</a>
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
