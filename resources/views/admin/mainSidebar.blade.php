<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
        <img src="admins/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
            <div class="image">
                <img src="admins/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>

            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-users-cog fa-sm"></i>
                        <p>
                            User management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">



                        <li class="nav-item">
                            <a href="{{ url('/admin/list-user') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Users management </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/index') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin management</p>

                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Banner --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-tv"></i>
                        <p>
                            Banner management
                     
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('banner/index') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Banner List </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('banner/create') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Banner</p>
                            </a>
                        </li>
                    </ul>
                </li>

                

                {{-- VOucher --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-sd-card"></i>
                        <p>
                            Voucher management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{URL::to('/insert_coupon')}}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Create Voucher </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/list_coupon')}}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Voucher List</p>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- bao cao daonh thu --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-sd-card"></i>
                        <p>
                            Statictical
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('statistical.index')}}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Income Statement </p>
                            </a>
                        </li>
                    </ul>
                </li>



                {{-- Order --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-sd-card"></i>
                        <p>
                            Order management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">



                        <li class="nav-item">
                            <a href="{{URL::to('/manage_order')}}" class="nav-link active ">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Order management </p>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- Review-Commnet --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-sd-card"></i>
                        <p>
                            Comment management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">



                        <li class="nav-item">
                            <a href="{{ route('listReview') }}" class="nav-link active ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Review</p>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- Blog --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-sd-card"></i>
                        <p>
                            Blog management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">



                        <li class="nav-item">
                            <a href="{{ url('blog/index') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog list</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('blog/create') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog Post</p>
                            </a>
                        </li>


                    </ul>
                </li>


                {{-- Category --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-sd-card"></i>
                        <p>
                            Category management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('category/create') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Create Category </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('category/index') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category List</p>
                            </a>
                        </li>
                    </ul>
                </li>



                {{-- Provider --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-sd-card"></i>
                        <p>
                            Provider management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">



                        <li class="nav-item">
                            <a href="{{ url('provider/index') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Provider list</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('provider/create') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Provider Create</p>
                            </a>
                        </li>


                    </ul>
                </li>



                {{-- Product --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
             <i class="fas fa-sd-card"></i>
                        <p>
                            Product management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">



                        <li class="nav-item">
                            <a href="{{ url('/admin/product/index') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product list</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/product/create') }}" class="nav-link bg-light text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product Create</p>
                            </a>
                        </li>


                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>