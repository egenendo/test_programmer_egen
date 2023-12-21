<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
            height="60" width="60">
    </div>
@include('layouts.navbar.index') {{-- Navbar Header --}}
@include('layouts.sidebar.index') {{-- Sidebar Header --}}
@yield('content')
@include('layouts.footer.index') {{-- Footer Header --}}
</div>

@include('layouts.footer.js') {{-- Footer Header --}}