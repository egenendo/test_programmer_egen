<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TEST PROGRAMMER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('home')}}" class="d-block">Egen Endo.L</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link {{ $activePage == 'Dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <span class="badge badge-info right">2</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-header">Produk</li>
                {{-- <li class="nav-item">
                    <a href="{{route('produk.index')}}" class="nav-link">
                        <i class="ion ion-bag"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item {{($activePage == 'List_Produk' ? 'menu-open' : ($activePage == 'List_Produk_Sell' ? 'menu-open' : ''))}}">
                    <a href="#" class="nav-link {{($activePage == 'List_Produk' ? 'active' : ($activePage == 'List_Produk_Sell' ? 'active' : ''))}}">
                        <i class="ion ion-bag"></i>
                        <p>
                            Produk
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('produk.index')}}" class="nav-link {{ $activePage == 'List_Produk' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produk List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('produk.produk_sell')}}" class="nav-link {{ $activePage == 'List_Produk_Sell' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produk Dijual</p>
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