  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 z-1">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <div>
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">حسام موسوی</a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link ">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                   مدیریت کاربران
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ route('usermanagement') }}" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>مدیریت کاربران</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{ route('createuser') }}" class="nav-link">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>افزودن کاربر</p>
                </a>
                </li>
            </ul>
            </li>


            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>
                        مدیریت مشتریان
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('customermanagement') }}" class="nav-link">
                        <i class="fa fa-users nav-icon"></i>
                        <p>مدیریت مشتریان</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('createcustomer') }}" class="nav-link">
                        <i class="fa fa-plus nav-icon"></i>
                        <p>افزودن مشتری</p>
                    </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('callhistory')}}" class="nav-link">
                            <i class="nav-icon fa fa-repeat"></i>
                            <p>
                            تاریخچه مکالمات
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reports')}}" class="nav-link">
                            <i class="nav-icon fa fa-repeat"></i>
                            <p>
                             گزارش گیری
                            </p>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    </div>
    <!-- /.sidebar -->
</aside>
