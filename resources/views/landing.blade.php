<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/landing/bootstrap.min.css') }}" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/landing/css/all.css') }}" />
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/landing/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/landing/slick-theme.css') }}" />
    <!-- Magnific popup CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/landing/magnific-popup.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/landing/style.css') }}" />
    <title>Medenin HTML Template</title>
</head>

<body>
    <!--==================== Header ====================-->
    <header>
        <div class="banner--wrap">
            <nav>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Nav menu -->
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <button class="navbar-toggler nav-custome1" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ml-auto">
                                        <!-- Add nav items here -->
                                    </ul>
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            </nav>
                            <!--//End Nav menu -->
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="banner-slider">
                    <div class="banner">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-5 d-flex align-items-center">
                                <div class="main-title">
                                    <span>We are here for you</span>
                                    <h1>
                                        What Makes Us Better, Makes You Better.
                                    </h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <a href="{{ route('register') }}" class="btn btn-primary">Make Appointment</a>
                                    {{-- <a href="https://www.youtube.com/watch?v=pBFQdxA-apI"
                                        class="play-btn popup-youtube"><i class="fas fa-play"></i></a> --}}
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-7 d-flex align-items-end">
                                <div class="anim-container flex-fill">
                                    <svg class="circle-svg" width="100%" height="100%" viewBox="0 0 754 733" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path class="big-circle" opacity="0.071" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M377 29C563.12 29 714 179.879 714 366C714 552.119 563.12 702.999 377 702.999C190.88 702.999 40 552.119 40 366C40 179.879 190.88 29 377 29Z"
                                            fill="#4D72D0" />
                                        <path class="small-circle" opacity="0.051" fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M376.471 120.995C512.043 120.995 621.947 230.898 621.947 366.471C621.947 502.043 512.043 611.946 376.471 611.946C240.898 611.946 130.995 502.043 130.995 366.471C130.995 230.898 240.898 120.995 376.471 120.995Z"
                                            fill="#4D72D0" />
                                    </svg>

                                    <img src="{{ asset('assets/images/hero-doctor-1.png') }}"
                                        class="img-fluid animated-hero" alt="hero" />

                                    <ul class="main-slider-social">
                                        <li>
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--==================== About Section ====================-->
    <section class="about-section">
        <div class="container container-custom">
            <div class="row">
                <div class="col-md-4">
                    <div class="service-thumbnail d-flex flex-fill">
                        <img src="{{ asset('assets/images/service-thumbnail01.png') }}" class="img-fluid" alt="#" />
                        <div class="service-thumbnail_text">
                            <h4>Specialised Service</h4>
                            <p>Lorem ipsum dolor sit</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-thumbnail d-flex flex-fill">
                        <img src="{{ asset('assets/images/service-thumbnail02.png') }}" class="img-fluid" alt="#" />
                        <div class="service-thumbnail_text">
                            <h4>24/7 Advanced Care</h4>
                            <p>Lorem ipsum dolor sit</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-thumbnail d-flex flex-fill">
                        <img src="{{ asset('assets/images/service-thumbnail03.png') }}" class="img-fluid" alt="#" />
                        <div class="service-thumbnail_text">
                            <h4>Get Result Online</h4>
                            <p>Lorem ipsum dolor sit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Add other sections of the page as per your content -->
    <footer>
        <div class="container container-custom">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>© Medenin 2020 Allright Reserved</p>
                        {{-- <a href="#" id="scroll"><i class="fas fa-angle-double-up"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <script src="{{ asset('assets/js/landing/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/landing/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/landing/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/landing/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/landing/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/landing/script.js') }}"></script>
</body>

</html>