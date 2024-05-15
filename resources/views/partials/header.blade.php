<div class="header-main px-3 px-lg-4">
    <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

    <div class=" me-auto">
    </div><!-- form-search -->

    <div class="dropdown dropdown-profile ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="avatar online"><img src="{{ asset('asset/img/img1.jpg') }}" alt=""></div>
        </a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <div class="dropdown-menu-body">
                <div class="avatar avatar-xl online mb-3"><img src="{{ asset('asset/img/img1.jpg') }}" alt="">
                </div>
                <h5 class="mb-1 text-dark fw-semibold">{{ Auth::user()->name ?? '' }}</h5>
                <nav class="nav">
                    <!-- <a href=""><i class="ri-user-settings-line"></i> Account Settings</a> -->
    			<a href="#"><i class="ri-logout-box-r-line"></i> Logout </a>
                </nav>
            </div><!-- dropdown-menu-body -->
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
</div><!-- header-main -->
