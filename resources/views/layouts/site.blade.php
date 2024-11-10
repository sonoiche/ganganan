<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name') }}</title>
        <!-- Fav Icon -->
        <link rel="shortcut icon" href="favicon.ico" />

        <!-- Owl carousel -->
        <link href="{{ url('site/css/owl.carousel.css') }}" rel="stylesheet" />

        <!-- Bootstrap -->
        <link href="{{ url('site/css/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- Font Awesome -->
        <link href="{{ url('site/css/font-awesome.css') }}" rel="stylesheet" />

        <!-- Custom Style -->
        <link href="{{ url('site/css/main.css') }}" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="{{ url('site/js/html5shiv.min.js') }}"></script>
            <script src="{{ url('site/js/respond.min.js') }}"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Header start -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-12 navbar-light">
                        <a href="{{ url('/') }}" class="logo"><img src="{{ url('site/images/logo.png') }}" alt="" /></a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-main" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        <!-- Nav start -->
                        <div class="navbar navbar-expand-lg navbar-light" role="navigation">
                            <div class="collapse navbar-collapse" id="nav-main">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">About us</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                                    @if (!auth()->check())
                                    <li class="nav-item"><a href="{{ url('login') }}" class="nav-link">Login</a></li>
                                    @endif
                                    <li class="nav-item postjob"><a href="{{ url('client/jobs/create') }}" class="nav-link">Post a job</a></li>
                                    <li class="nav-item jobseeker"><a href="{{ url('jobs') }}" class="nav-link">Job Seeker</a></li>
                                    <li class="nav-item dropdown userbtn">
                                        <a href="#" class="nav-link"><img src="{{ url('site/images/candidates/01.jpg') }}" alt="" class="userimg" /></a>
                                        @if (auth()->check())
                                        <ul class="dropdown-menu">
                                            <li class="nav-item" style="margin: 3px 0">
                                                <a href="{{ url('home') }}" class="nav-link">
                                                    <i class="fa fa-tachometer fa-fw" aria-hidden="true"></i> 
                                                    Dashboard
                                                </a>
                                            </li>
                                            <li class="nav-item" style="margin: 3px 0">
                                                <a href="#" class="nav-link">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                                    Edit Profile
                                                </a>
                                            </li>
                                            <li class="nav-item" style="margin: 3px 0">
                                                <a href="{{ url('client/jobs') }}" class="nav-link">
                                                    <i class="fa fa-briefcase fa-fw" aria-hidden="true"></i>
                                                    My Jobs
                                                </a>
                                            </li>
                                            <li class="nav-item" style="margin: 3px 0">
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                                                    <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>
                                                    Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                        @endif
                                    </li>
                                </ul>
                                <!-- Nav collapes end -->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- Nav end -->
                    </div>
                </div>
                <!-- row end -->
            </div>
            <!-- Header container end -->
        </div>
        <!-- Header end -->
        @yield('content')
        <!--Footer-->
        <div class="footerWrap">
            <div class="container">
                <div class="row">
                    <!--About Us-->
                    <div class="col-md-3 col-sm-12">
                        <div class="ft-logo"><img src="{{ url('site/images/logo.png') }}" alt="Your alt text here" /></div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et consequat elit. Proin molestie eros sed urna auctor lobortis. Integer eget scelerisque arcu. Pellentesque scelerisque pellentesque nisl, sit amet
                            aliquam mi pellentesque fringilla. Ut porta augue a libero pretium laoreet. Suspendisse sit amet massa accumsan, pulvinar augue id, tristique tortor.
                        </p>

                        <!-- Social Icons -->
                        <div class="social">
                            <a href="#." target="_blank"> <i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#." target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                            <a href="#." target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> <a href="#." target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                            <a href="#." target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
                        </div>
                        <!-- Social Icons end -->
                    </div>
                    <!--About us End-->

                    <!--Quick Links-->
                    <div class="col-md-2 col-sm-6">
                        <h5>Quick Links</h5>
                        <!--Quick Links menu Start-->
                        <ul class="quicklinks">
                            <li><a href="#.">Career Services</a></li>
                            <li><a href="#.">CV Writing</a></li>
                            <li><a href="#.">Career Resources</a></li>
                            <li><a href="#.">Company Listings</a></li>
                            <li><a href="#.">Success Stories</a></li>
                            <li><a href="#.">Contact Us</a></li>
                            <li><a href="#.">Create Account</a></li>
                            <li><a href="#.">Post a Job</a></li>
                            <li><a href="#.">Contact Sales</a></li>
                        </ul>
                    </div>
                    <!--Quick Links menu end-->

                    <!--Jobs By Industry-->
                    <div class="col-md-3 col-sm-6">
                        <h5>Jobs By Industry</h5>
                        <!--Industry menu Start-->
                        <ul class="quicklinks">
                            <li><a href="#.">Information Technology Jobs</a></li>
                            <li><a href="#.">Recruitment/Employment Firms Jobs</a></li>
                            <li><a href="#.">Education/Training Jobs</a></li>
                            <li><a href="#.">Manufacturing Jobs</a></li>
                            <li><a href="#.">Call Center Jobs</a></li>
                            <li><a href="#.">N.G.O./Social Services Jobs</a></li>
                            <li><a href="#.">BPO Jobs</a></li>
                            <li><a href="#.">Textiles/Garments Jobs</a></li>
                            <li><a href="#.">Telecommunication/ISP Jobs</a></li>
                        </ul>
                        <!--Industry menu End-->
                        <div class="clear"></div>
                    </div>

                    <!--Latest Articles-->
                    <div class="col-md-4 col-sm-12">
                        
                    </div>
                </div>
            </div>
        </div>
        <!--Footer end-->

        <!--Copyright-->
        <div class="copyright">
            <div class="container">
                <div class="bttxt">Copyright &copy; 2021 Your Company Name. All Rights Reserved. Design by: <a href="https://www.piratestechnologies.com/" target="_blank">Pirates Technologies</a></div>
            </div>
        </div>

        <!-- Bootstrap's JavaScript -->
        <script src="{{ url('site/js/jquery.min.js') }}"></script>
        <script src="{{ url('site/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('site/js/popper.min.js') }}"></script>

        <!-- Owl carousel -->
        <script src="{{ url('site/js/owl.carousel.js') }}"></script>

        <!-- Custom js -->
        <script src="{{ url('site/js/script.js') }}"></script>
    </body>
</html>