<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="description" content="ogani template">
    <meta name="keywords" content="ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Quản lí học phí sinh viên</title>

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- css styles -->
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.css" rel="stylesheet">  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script> 
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
@yield('css')
</head>

<body>
    <!-- success noti -->

    @if(isset($success))
    <div class="alert alert-success" role="alert">
        {{$success;}}
    </div>
    @endif
    <!-- error -->
    @if(isset($error))
    <div class="alert alert-warning" role="alert">
        {{ $error}}
    </div>
    @endif
    <!-- end noti -->
    <!-- page preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- humberger begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('site/img/logo.png') }}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- humberger end -->

    <!-- header section begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{route('welcome')}}"><img src="{{ asset('site/img/logo_bkacad.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 push-4">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{route('welcome')}}">Trang chủ</a></li>
                            <li><a href="#">Quy định học phí</a>
                            </li>
                            <li><a href="{{ route('profile') }}">Thông tin sinh viên</a></li>
                            <li>
                                
                                <ul class="nav navbar-nav navbar-right">
                                    <a href="{{route('profile')}}">Hi {{ Session::get('student.lastname') }}</a>
                                    <li class="dropdown">                                        
                                        <a onClick="return confirm('Are you sure want to logout')" href="{{route('logout')}}">Logout</a>                                      
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- header section end -->

@yield('main')
<!-- footer section begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="#"><img src="{{ asset('site/img/logo_bkacad.png') }}" alt=""></a>
                    </div>
                    <ul>
                        <li>address: hai ba trung, ha noi</li>
                        <li>phone: +84 336.227.0120</li>
                        <li>email: phanmaiduyen3@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>useful links</h6>
                    <ul>
                        <li><a href="#">quy định học phí</a></li>
                        <li><a href="#">tin tức học viện</a></li>
                        <li><a href="#">thông tin sinh viên</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    một cái gì đó
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text"><p><script>document.write(new date().getfullyear());</script><i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">colorlib</a>
                        <!-- link back to colorlib can't be removed. template is licensed under cc by 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="{{ asset('site/img/payment-item.png') }}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section end -->
@yield('js')
    <!-- js plugins -->

    <script src="{{ asset('site/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('site/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('site/js/main.js') }}"></script>

</body>

</html>