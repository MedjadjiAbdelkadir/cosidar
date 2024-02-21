{{-- This is head page --}}
@include('layouts.Home.head')
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status"></div>
        <img class="position-absolute top-50 start-50 translate-middle" src=" {{ asset('cosidar/logo.png') }}" width="50" alt="Icon">
    </div>
        <!-- Spinner End -->
    {{--  Navbar Start --}}
    @include('layouts.Home.Navbar.navbar')

    @yield('content')

{{-- this is footer page --}}
@include('layouts.Home.footer')
{{-- thisis scripte page --}}
@include('layouts.Home.scripts')
