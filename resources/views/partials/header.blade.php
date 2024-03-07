
<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from thetork.com/demos/html/uevent/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Mar 2024 12:40:08 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uevent- Multipurpose Event, Conference & Meetup HTML5 Template</title>

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lightcase.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/swiper-bundle.min.css')}}">

    <!-- main css for template -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>

    <!-- ===============>> Preloader start here <<================= -->
    <div class="preloader">
        <img src="{{asset('assets/images/logo/preloader.gif')}}" alt="Uevent">
    </div>
    <!-- ===============>> Preloader end here <<================= -->

        <!-- ========== Multipage Header Section Starts Here========== -->
        <header class="header-section">
            <div class="header-bottom">
                <div class="container">
                    <div class="header-wrapper">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo">
                            </a>
                        </div>
                        <div class="menu-area">
                            <ul class="menu">
                                <li>
                                    <a href="#home">Home</a>
                                    <ul class="submenu">
                                        <li><a href="index.html">Home Multi</a></li>
                                        <li><a href="index-single.html">Home Single</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#about">About</a>
                                    <ul class="submenu">
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="speaker.html">Speakers</a></li>
                                        <li><a href="speaker-single.html">Speaker Details</a></li>
                                        <li><a href="schedule.html">Event Schedule</a></li>
                                        <li><a href="pricing.html">Ticket Pricing</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#team">Blog</a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#faq">Pages</a>
                                    <ul class="submenu">
                                        <li><a href="schedule.html">Schedule</a></li>
                                        <li><a href="pricing.html">Pricing</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="speaker.html">Speakers</a></li>
                                        <li><a href="speaker-single.html">Speaker single</a></li>
                                        <li><a href="signup.html">Sign Up</a></li>
                                        <li><a href="signin.html">Sign In</a></li>
                                        <li><a href="forgot-pass.html">Reset Password</a></li>
                                        <li><a href="coming-soon.html">Coming Soon</a></li>
                                        <li><a href="404.html">404 Page</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="contact.html">Contact</a>
                                </li>
                                <li>
                                    <a href="{{route('dashboard')}}">Dashboard</a> 
                                </li>
                                <li>
                                    <a href="{{route('Myreservations')}}">My Reservation</a> 
                                </li>
                            </ul>
                            <div class="header-btn">
                                <a href="#" class="default-btn move-right">
                                    <span>Join Now <i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>
    
                            <!-- toggle icons -->
                            <div class="header-bar d-lg-none">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== Multipage Header Section Ends Here========== -->

        <main>
            @yield('content')
        </main>

        <x-footer></x-footer>