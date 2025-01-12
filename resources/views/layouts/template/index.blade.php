<div class="wrapper">
@include('layouts.navbar.index') {{-- Navbar Header --}}
@include('layouts.sidebar.index') {{-- Sidebar Header --}}
@yield('content')
@include('layouts.footer.index') {{-- Footer Header --}}
</div>
@include('layouts.footer.js') {{-- Footer Header --}}