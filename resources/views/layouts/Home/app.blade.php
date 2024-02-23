{{-- This is head page --}}
@include('layouts.Home.head')
<body>
<div id="index" class="container-xxl">
    <div class="container">
        <div class="d-flex justify-content-center mt-1">
            <div class="text-center">
                <h2 style="color: #388482;" class="">الجمهورية الجزائرية الديمقراطية الشعبية</h2>
                <h2 style="color: #388482;" class="">المديرية العامة الأشغال العمومية</h2>
            </div>
        </div>
        <div style="margin-top: -25px;" class="d-flex justify-content-between">
            <img src="{{ asset('cosidar/logo.png') }}" alt="">
            <img src="{{ asset('cosidar/cosidar.jpg') }}" alt="">
        </div>
        <div style="margin-top: -15px;" class="d-flex justify-content-center">
            <div class="text-center">
                <h1 style="font-size: 200px; color: #388482;" id="countdown"></h1>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 style="font-size: 80px; color: #388482;" id="text"></h1>
            </div>
        </div>

    </div>
</div>
<div id="pageHome">
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
</div>