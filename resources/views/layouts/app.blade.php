<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<!--Designerd by: http://bootstrapthemes.co-->
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="favicon.ico">

    <!--Google Font link-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fonticons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/iconic/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootsnav.css')}}">

    <link rel="stylesheet" href="{{asset('assets/hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/daterangepicker/daterangepicker.css')}}">

    <link rel="stylesheet" href="{{asset('assets/login/util.css')}}">
    <link rel="stylesheet" href="{{asset('assets/login/main.css')}}">
    <!--For Plugins external css-->
    <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->

    <!--<link rel="stylesheet" href="assets/css/colors/maron.css">-->

    <!--Theme Responsive css-->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}" />


    <!--Theme custom css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <script src="{{asset('assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
</head>

<body data-spy="scroll" data-target=".navbar-collapse">


<!-- Preloader -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>
        </div>
    </div>
</div><!--End off Preloader -->


<div class="culmn">
    <!--Home page style-->


    <nav class="navbar navbar-default navbar-fixed white no-background bootsnav">
        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">

                <div class="row" style="margin-bottom: -25px;margin-top: 8px;">
                    <div class="col-md-12">
                        @if(!\Illuminate\Support\Facades\Auth::check())
                            <span class="pull-right"><span class="badge">
                                <a href="{{url('signup')}}" style="color: #00F3FF; font-weight: bold; font-size: medium;">
                                    <i class="fa fa-user-plus"></i> &nbsp;&nbsp;S'enregistrer
                                </a>
                            </span>
                                </span>

                                <span class="pull-right"><span class="badge">
                                <a href="{{url('/login')}}" style="color: #00F3FF; font-weight: bold; font-size: medium;">
                                    <i class="fa fa-key"></i>&nbsp;&nbsp;Connexion
                                </a>
                            </span>
                                &nbsp;&nbsp;
                            </span>

                        @else

                            <span class="pull-right"><span class="badge">
                                <a href="{{url('logout')}}" style="color: #00F3FF; font-weight: bold; font-size: medium;">
                                    <i class="fa fa-sign-out"></i> &nbsp;&nbsp;Se Deconnecter
                                </a>
                            </span>
                                </span>

                            <span class="pull-right"><span class="badge">
                                <a href="" style="color: #00F3FF; font-weight: bold; font-size: medium;">
                                    <i class="fa fa-user"></i>&nbsp;&nbsp;<span style="font-size: large">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                </a>
                            </span>
                                &nbsp;&nbsp;
                            </span>


                        @endif
                    </div>
                </div>

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#brand">

                        <img src="{{asset('assets/images/logo.png')}}" class="logo logo-display m-top-10" alt="" height="50" width="105">
                        <img src="{{asset('assets/images/logo.jpg')}}" class="logo logo-scrolled" alt="" height="50" width="105">

                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp" style="margin-left: 75px;">
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span class="menu-link-color">Identity And Access</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    <a href="{{url('signup')}}" style="color: #00F3FF; font-weight: bold; font-size: medium;">
                                        <i class="fa fa-user-plus"></i> &nbsp;&nbsp;S'enregistrer
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/login')}}">Inviter un Collaborateur</a>
                                </li>

                                <li class="divider" style="height: 1px; "></li>

                                <li>
                                    <a href="{{url('/login')}}">Modifier Mot de Passe</a>
                                </li>
                                <li>
                                    <a href="{{url('/login')}}">Parametrer son Compte</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-link-color">Transactions</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    <a href="{{url('/login')}}">Liste de Transactions </a>
                                </li>



                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-link-color">Nos Services</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    <a href="{{url('/login')}}">Catalogue</a>
                                </li>

                                <li>
                                    <a href="{{url('/login')}}">Valider Un Service</a>
                                </li>

                                <li>
                                    <a href="{{url('/login')}}">Payer Un Service</a>
                                </li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-link-color">Porte Monnaie</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    <a href="{{url('/login')}}">Recharger Mon Compte</a>
                                </li>

                                <li>
                                    <a href="{{url('/login')}}">Mon Solde</a>
                                </li>

                                <li>
                                    <a href="{{url('/login')}}">Mes Mouvements</a>
                                </li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-link-color">Etablir de prix</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    <a href="{{url('/login')}}">Parametrer le prix d'un service</a>
                                </li>

                                <li>
                                    <a href="{{url('/login')}}">Inserer un Bonus / Offre</a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>

    </nav>


    <section id="commonsection" class="home bg-mega">
        @yield('commonsection')
    </section> <!--End off Home Sections-->


    <!-- scroll up-->
    <div class="scrollup">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div><!-- End off scroll up -->


    <footer id="footer" class="footer bg-black">
        <div class="container">
            <div class="row">
                <div class="main_footer text-center p-top-40 p-bottom-30">
                    <p class="wow fadeInRight" data-wow-duration="1s">
                        Made with
                        <i class="fa fa-heart"></i>
                        by
                        <a target="_blank" href="http://bootstrapthemes.co">Bootstrap Themes</a>
                        2016. All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>




</div>

<!-- JS includes -->

<script src="{{asset('assets/js/vendor/jquery-1.11.2.min.js')}}"></script>
<script src="{{asset('assets/animsition/js/animsition.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('assets/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/countdowntime/countdowntime.js')}}"></script>

<script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.collapse.js')}}"></script>
<script src="{{asset('assets/js/bootsnav.js')}}"></script>

<script src="{{asset('js/main.js')}}"></script>

<script src="js/main.js"></script>

<!-- paradise slider js -->


<script src="http://maps.google.com/maps/api/js?key=AIzaSyD_tAQD36pKp9v4at5AnpGbvBUsLCOSJx8"></script>
<script src="{{asset('assets/js/gmaps.min.js')}}"></script>

<script>
    function showmap() {
        var mapOptions = {
            zoom: 8,
            scrollwheel: false,
            center: new google.maps.LatLng(-34.397, 150.644),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        $('.mapheight').css('height', '350');
        $('.maps_text h3').hide();
    }

</script>




<script src="{{asset('assets/js/plugins.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

<script type="text/javascript">

</script>

</body>
</html>