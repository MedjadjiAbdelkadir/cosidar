 <!-- Topbar Start -->
 <div class="container-fluid bg-dark p-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-3">
                <a class="text-body px-2" href="tel:+021 45 33 33"><i class="fa fa-phone-alt text-primary me-2"></i>021 45 33 33</a>
                <a class="text-body px-2" href="mailto:contact@cosidar.dz"><i class="fa fa-envelope-open text-primary me-2"></i>contact@cosidar.dz</a>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-2">
                <div>
                    <h5 class="text-primary">
                        {{ __('الجمهورية الجزائرية الديموقرطية الشعبية') }}
                    </h5>
                </div>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-sm-square btn-outline-body me-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="{{ URL('/') }}" class="navbar-brand ms-4 ms-lg-0">
        <h1 class="text-primary m-0"><img class="me-3" src="{{ asset('cosidar/logo.png') }}" width="100" alt="Icon">Cosidar</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ URL('/') }}"  class="nav-item nav-link active">Home</a>
            <a href="#about" class="nav-item nav-link">About</a>
            <a href="#services" class="nav-item nav-link">Services</a>
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu border-0 m-0">
                    <a href="feature.html" class="dropdown-item">Our Features</a>
                    <a href="project.html" class="dropdown-item">Our Projects</a>
                    <a href="team.html" class="dropdown-item">Team Members</a>
                    <a href="appointment.html" class="dropdown-item">Appointment</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a>
                </div>
            </div> --}}
            <a href="#choose" class="nav-item nav-link">Why choose us</a>
        </div>
        <a href="{{ url('/login') }}" class="btn btn-primary py-2 px-4 d-none d-lg-block">Log In</a>
    </div>
</nav>
<!-- Navbar End -->
