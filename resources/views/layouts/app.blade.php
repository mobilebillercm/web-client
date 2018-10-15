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
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-slider.css')}}">
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

    <link rel="stylesheet" href="{{asset('assets/css/flipper.css')}}">
    {{--<link rel="stylesheet" href="{{asset('assets/css/aruba.css')}}">--}}

    <style>
        input[type=range] {
            -webkit-appearance: none;
            margin: 10px 0;
            width: 100%;
        }
        input[type=range]:focus {
            outline: none;
        }
        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 12.8px;
            cursor: pointer;
            animate: 0.2s;
            box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
            background: #3db4e1;
            border-radius: 25px;
            border: 0px solid #000101;
        }
        input[type=range]::-webkit-slider-thumb {
            box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
            border: 0px solid #000000;
            height: 20px;
            width: 39px;
            border-radius: 7px;
            background: #225274;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -3.6px;
        }
        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #3db4e1;
        }
        input[type=range]::-moz-range-track {
            width: 100%;
            height: 12.8px;
            cursor: pointer;
            animate: 0.2s;
            box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
            background: #3db4e1;
            border-radius: 25px;
            border: 0px solid #000101;
        }
        input[type=range]::-moz-range-thumb {
            box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
            border: 0px solid #000000;
            height: 20px;
            width: 39px;
            border-radius: 7px;
            background: #3db4e1;
            cursor: pointer;
        }
        input[type=range]::-ms-track {
            width: 100%;
            height: 12.8px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            border-width: 39px 0;
            color: transparent;
        }
        input[type=range]::-ms-fill-lower {
            background: #3db4e1;
            border: 0px solid #000101;
            border-radius: 50px;
            box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
        }
        input[type=range]::-ms-fill-upper {
            background: #3db4e1;
            border: 0px solid #000101;
            border-radius: 50px;
            box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
        }
        input[type=range]::-ms-thumb {
            box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
            border: 0px solid #000000;
            height: 20px;
            width: 39px;
            border-radius: 7px;
            background: #225274;
            cursor: pointer;
        }
        input[type=range]:focus::-ms-fill-lower {
            background: #3db4e1;
        }
        input[type=range]:focus::-ms-fill-upper {
            background: #3db4e1;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".navbar-collapse">


<!-- Preloader -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            {{--<div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>--}}
            <img src="{{asset('/assets/images/blue_loading.gif')}}" height="112" width="112">
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
                            <span class="pull-right"><span class="">
                                <a href="{{url('id/signup')}}" style="color: #3db4e1; font-weight: bold; font-size: medium;">
                                    <i class="fa fa-user-plus"></i> &nbsp;&nbsp;S'enregistrer
                                </a>
                            </span>

                                </span>

                                <span class="pull-right"><span class="">
                                <a href="{{url('id/login')}}" style="color: #3db4e1; font-weight: bold; font-size: medium;">
                                    <i class="fa fa-key"></i>&nbsp;&nbsp;Connexion
                                </a>
                            </span>
                                 &nbsp;&nbsp;&nbsp;<strong style="font-size: large; color: #3db4e1;">|</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                            </span>

                        @else

                            <span class="pull-right"><span class="">
                                <a href="{{url('id/logout')}}" style="color: #3db4e1; font-weight: bold; font-size: medium;">
                                    <i class="fa fa-sign-out"></i> &nbsp;&nbsp;Se Deconnecter
                                </a>
                            </span>
                                </span>

                            <span class="pull-right"><span class="">
                                <a href="" style="color: #3db4e1; font-weight: bold; font-size: medium;">
                                    <i class="fa fa-user"></i>&nbsp;&nbsp;<span style="font-size: large">{{\Illuminate\Support\Facades\Auth::user()->firstname . '  ' . \Illuminate\Support\Facades\Auth::user()->lastname}}</span>
                                    <span style="font-size: small;"> @({{\Illuminate\Support\Facades\Auth::user()->tenant_name}})</span>
                                </a>
                            </span>
                                &nbsp;&nbsp; <strong style="font-size: large; color: #3db4e1;">|</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                            </span>


                        @endif
                    </div>
                </div>

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}" >

                        <img src="{{asset('assets/images/logo0.png')}}" class="logo logo-display m-top-10" alt="">
                        <img src="{{asset('assets/images/logo.png')}}" class="logo logo-scrolled" alt="" >

                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                @if(\Illuminate\Support\Facades\Auth::check())
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp" style="margin-left: 75px;">
                        <li class="">
                            <a href="{{url('')}}" ><span class="menu-link-color"><i class="fa fa-home" style="font-size: 25px; margin-top: -8px;"></i> Accueil</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-link-color">Nos Services</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    <a href="{{url('/services')}}">Catalogue</a>
                                </li>

                                <li>
                                    <a href="{{url('/services/'.\Illuminate\Support\Facades\Auth::user()->userid)}}">Mes Services</a>
                                </li>
                                <li>
                                    <a href="{{url('/')}}">Payer Un Service</a>
                                </li>

                                @if(\Illuminate\Support\Facades\Auth::user()->userid === env('SUPER_ADMINISTRATOR_ID'))
                                    <li>
                                        <a href="{{url('/services/add/new')}}"><i class="fa fa-plus-square"></i> Creer un Service</a>
                                    </li>
                                @endif

                            </ul>
                        </li>

                        <?php
                           $roles = json_decode(\Illuminate\Support\Facades\Auth::user()->roles)
                        ?>
                        @if(\Illuminate\Support\Facades\Auth::user()->userid === env('SUPER_ADMINISTRATOR_ID'))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-link-color">Etablir les prix</span></a>
                                <ul class="dropdown-menu" style="margin-top: -20px;">
                                    <li>
                                        <a href="{{url('/parametrer-prix-service')}}">Parametrer le prix d'un service</a>
                                    </li>

                                    <li>
                                        <a href="{{url('/login')}}">Inserer un Bonus / Offre</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        {{--@endif--}}

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-link-color">Porte Monnaie</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    <a href="{{url('wallet/walets')}}">Recharge de Compte</a>
                                </li>

                                {{--<li>
                                    <a href="{{url('wallet/balance')}}" onclick="getBalance('{{\Illuminate\Support\Facades\Auth::user()->email}}'); return false;">Mon Solde</a>
                                </li>--}}

                                <li>
                                    <a href="{{url('wallet/transactions/' . \Illuminate\Support\Facades\Auth::user()->userid)}}">Operations Sur mon Compte</a>
                                </li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-link-color">Tickets</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    <a href="{{url('tickets/tickets/'.\Illuminate\Support\Facades\Auth::user()->userid)}}">Tickets Imprimes </a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown" id="accountmenu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span class="menu-link-color">Mon Compte</span></a>
                            <ul class="dropdown-menu" style="margin-top: -20px;">
                                <li>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <br>
                                        <span style="color: #3db4e1; padding: 20px 10px 10px 10px; margin-top: -10px;">{{\Illuminate\Support\Facades\Auth::user()->email}}</span><br>
                                        <span style="color: #3db4e1; padding: 20px 10px 10px 10px; margin-top: -10px;">
                                            Solde: <strong id="myaccount_balance"></strong> <img  src="{{asset('assets/images/loader.gif')}}" height="20" width="15"
                                            style="display: none;" id="myaccount_balance_loader"/> <i id="userid" style="display: none;">{{\Illuminate\Support\Facades\Auth::user()->userid}}</i>
                                        </span>
                                    @endif
                                    <a href="{{url('id/invitation')}}"> <i class="fa fa-user-plus"></i> &nbsp;&nbsp;Inviter un Collaborateur</a>
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

                    </ul>
                </div><!-- /.navbar-collapse -->

                @else
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp" style="margin-left: 75px;">
                            <li class="">
                                <a href="{{url('')}}" ><span class="menu-link-color"><i class="fa fa-home" style="font-size: 30px;"></i> Accueil</span></a>
                            </li>

                        </ul>
                    </div>
                @endif
            </div>
        </div>

    </nav>


    <section id="commonsection" class="home bg-mega">
        <img src="{{asset('assets/images/loader.gif')}}" id="loading"
             style="border-radius: 50%; height: 80px; width: 73px; position: fixed; top: 48%; left: 48%; z-index: 500; display: none;">
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="openmodal" style="display: none;">
                        Launch demo modal
                    </button>


                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Solde </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="home-prodotto-prezzo" style="font-size: 35px;"><strong id="balance"></strong><sup>FCFA</sup><sub></sub></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="wow fadeInRight" data-wow-duration="1s">
                        Made with
                        <i class="fa fa-heart"></i>
                        by
                        <a target="_blank" href="http://bootstrapthemes.co">Bootstrap Themes</a>
                        2016. All Rights Reserved
                    </p>
                    <p>

                        <a href="{{url('id/signup')}}" style="color: #3db4e1; font-weight: bold; font-size: medium;">
                            <i class="fa fa-user-plus"></i> &nbsp;&nbsp;S'enregistrer
                        </a>

                    </p>
                </div>
            </div>
        </div>
    </footer>




</div>

<!-- JS includes -->

<script src="{{asset('assets/js/vendor/jquery-1.11.2.min.js')}}"></script>
{{--<script src="{{asset('assets/js/vendor/jquery-mobile.js')}}"></script>--}}

<script src="{{asset('assets/animsition/js/animsition.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap-slider.js')}}"></script>
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

{{--<script src="js/main.js"></script>--}}

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

    $(document).ready(function () {


        $('.filterable .btn-filter').click(function(){
            //alert("voila");
            var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e){
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function(){
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }
        });

        $('#accountmenu').on('show.bs.dropdown', function () {
            //alert('Showing...');
            $('#myaccount_balance').html('') ;
            $.ajax({
                async:true,
                beforeSend:function(jqXHR, settings){
                    $('#myaccount_balance_loader').show();
                },
                complete:function(jqXHR ,textStatus){
                    $('#myaccount_balance_loader').hide();
                },
                dataType: "json",
                error:function(jqXHR, textStatus,errorThrown){
                    $('#myaccount_balance_loader').hide();
                },
                url: '/wallet/mobilebillercreditaccounts/' + $('#userid').html() + "?query=balance",
                data: '',
                success: function (data) {
                    console.log("ENTREEEEEE222222222: \n\n" + JSON.stringify(data));

                    if (data.success === 1 && data.faillure === 0){
                        $('#myaccount_balance').html(data.response ) ;
                    }else {
                        $('#balance_content').html('<i style="color: red;">' + data.raison + '</i>') ;
                    }

                    //$('#openmodal').trigger('click');
                },
                error:function(jqXHR, textStatus,errorThrown){
                    console.log("Error: " + JSON.stringify(errorThrown));
                    $('#myaccount_balance').html('<i style="color: red;">' + JSON.stringify(errorThrown) + '</i>') ;
                    //$('#openmodal').trigger('click');
                }
            });
        });

        $('#payment_methode11').trigger('click');
        /*$('#payment_methode11').click(function () {
            //alert("clicked");
            $('#mobilemoneyform').show('slow');
            $('#creditcardform').hide('slow');
        });*/

        $('#payment_methode22').click(function () {
            $('#mobilemoneyform').hide('slow');
            $('#creditcardform').show('slow');
        });

        $('.popovertransactiondetails').popover({
            container: 'body',
            html:true/*,
            template:'<div class="panel panel-primary popover" role="tooltip">' +
                        '<div class="arrow"></div>' +
                        '<div class="panel-heading">\n' +
                        '    <h3 class="panel-title popover-header"></h3>\n' +
                        '    <div class="pull-right">\n' +
                        '    </div>\n' +
                        '</div>'+
                        '<div class="popover-body panel-body"></div>' +
                    '</div>'*/
        });
        //$('[data-toggle="popover"]').popover();

    });

    function getPrice(serviceid, quantity){


        $.ajax({
            async:true,
            beforeSend:function(jqXHR, settings){
                $('#loading').show();
            },
            complete:function(jqXHR ,textStatus){
                $('#loading').hide();
            },
            dataType: "json",
            error:function(jqXHR, textStatus,errorThrown){
                $('#loading').hide();
            },
            url: '/pricing/calculate-paid-service-price/' + serviceid + '/' + quantity,
            data: '',
            success: function (data) {
                console.log("ENTREEEEEE222222222: \n\n" + JSON.stringify(data));

                if (data.success === 1 && data.faillure === 0){

                    var price = data.response;
                    $('#total_amount_' + serviceid).html(price.amount.value);
                    $('#price_' + serviceid).val(price.amount.value);

                    var vet1 = $('#' + serviceid).val().split('.');
                    //alert($('#price').val());
                    $('#n_unit_' + serviceid).html((parseInt(vet1[0]) === 0)?'':'' + vet1[0] + '');
                    $('#decimal_unit_' + serviceid).html((vet1.length === 1)?'':'' + '2 Semaines');
                }else {
                    //$('#balance').html(data.raison) ;
                }

                //$('#openmodal').trigger('click');
            },
            error:function(jqXHR, textStatus,errorThrown){
                console.log("Error: " + JSON.stringify(errorThrown));
                //$('#balance').html(JSON.stringify(errorThrown)) ;
                //$('#openmodal').trigger('click');
            }
        });
    }

    function getBalance(username) {

        $.ajax({
            async:true,
            beforeSend:function(jqXHR, settings){
                $('#loading').show();
            },
            complete:function(jqXHR ,textStatus){
                $('#loading').hide();
            },
            dataType: "json",
            error:function(jqXHR, textStatus,errorThrown){
                $('#loading').hide();
            },
            url: 'http://localhost:8000/wallet/mobilebillercreditaccounts/' + username + "?query=balance",
            data: '',
            success: function (data) {
                console.log("ENTREEEEEE222222222: \n\n" + JSON.stringify(data));

                if (data.success === 1 && data.faillure === 0){
                    $('#balance').html(data.response) ;
                }else {
                    $('#balance').html(data.raison) ;
                }

                $('#openmodal').trigger('click');
            },
            error:function(jqXHR, textStatus,errorThrown){
                console.log("Error: " + JSON.stringify(errorThrown));
                $('#balance').html(JSON.stringify(errorThrown)) ;
                $('#openmodal').trigger('click');
            }
        });


    }


    function exchangeVisibility(a,b, c) {
        $('#' + b).hide('fast', function () {
            $('#' + a).show('fast',function () {
                if (a == 'mobilemoneyform'){
                    $('#cardnumber').val('');
                    $('#cardholder').val('');
                    $('#expired_date').val('');
                    $('#securitycode').val('');
                    $('#password').val('');
                } else if(a === 'creditcardform') {
                    $('#phonenumber').val('');
                    $('#holder').val('');
                    $('#password').val('');
                }else {
                    $('#cardnumber').val('');
                    $('#cardholder').val('');
                    $('#expired_date').val('');
                    $('#securitycode').val('');
                    $('#phonenumber').val('');
                    $('#holder').val('');
                }
            });
        });
        $('#' + c).hide('fast');
    }

    $('#phonenumber').change(function () {
        $('#card_number').val($('#phonenumber').val());
    });

    $('#holder').change(function () {
        $('#card_holder').val($('#holder').val());
    });



    $('#cardnumber').change(function () {
        $('#card_number').val($('#cardnumber').val());
    });

    $('#cardholder').change(function () {
        $('#card_holder').val($('#cardholder').val());
    });

    $('#expired_date').change(function () {
        $('#expiry_date').val($('#expired_date').val());
    });

    $('#securitycode').change(function () {
        $('#security_code').val($('#securitycode').val());
    });


    function setPaymentMethodTypeAndIssuer(paymentmethodtype, provider) {
        $('#payment_method_id').val(paymentmethodtype);
        $('#issuer').val(provider);
        //alert($('#issuer').val())
    }


    function setPaymentMethodTypeId(paymentmethodtype) {
        $('#payment_method_id').val(paymentmethodtype);
    }
    
    function submitStep2Paymentform() {
        document.getElementById('form-payment-step2').submit();
    }

    function submitFormTopup() {
        document.getElementById('form-topup').submit();
    }

    function submitForm(id) {
        document.getElementById(id).submit();
    }

    function getBalancewithNiceLoader(username) {

        $.ajax({
            async:true,
            beforeSend:function(jqXHR, settings){
                $('#balance-loader').show();
            },
            complete:function(jqXHR ,textStatus){
                $('#balance-loader').hide();
            },
            dataType: "json",
            error:function(jqXHR, textStatus,errorThrown){
                $('#balance-loader').hide();
            },
            url: '/wallet/mobilebillercreditaccounts/' + username + "?query=balance",
            data: '',
            success: function (data) {
                console.log("ENTREEEEEE222222222: \n\n" + JSON.stringify(data));

                if (data.success === 1 && data.faillure === 0){
                    $('#balance_content').html('Solde<br>' + data.response + '<br>') ;
                }else {
                    $('#balance_content').html('<i style="color: red;">' + data.raison + '</i>') ;
                }

                //$('#openmodal').trigger('click');
            },
            error:function(jqXHR, textStatus,errorThrown){
                console.log("Error: " + JSON.stringify(errorThrown));
                $('#balance_content').html('<i style="color: red;">' + JSON.stringify(errorThrown) + '</i>') ;
                //$('#openmodal').trigger('click');
            }
        });
    }

    function loadBenefiaryByTenant(tenant) {

        $.ajax({
            async:true,
            beforeSend:function(jqXHR, settings){
                $('#benefiary-loader').show();
            },
            complete:function(jqXHR ,textStatus){
                $('#benefiary-loader').hide();
            },
            dataType: "json",
            error:function(jqXHR, textStatus,errorThrown){
                $('#benefiary-loader').hide();
            },
            url: '/wallet/users/' + tenant ,
            data: '',
            success: function (data) {
                console.log("ENTREEEEEE222222222: \n\n" + JSON.stringify(data));
                var strinoption = '<option value="">--- Beneficiaire ---</option>';
                for (var i = 0; i<data.length; i++){
                    strinoption += '<option value="'+data[i].userid+'">'+data[i].firstname + '  ' + data[i].lastname+'</option>';
                }
                $('#beneficiary').html(strinoption);
            },
            error:function(jqXHR, textStatus,errorThrown){
                console.log("Error: " + JSON.stringify(errorThrown));
                $('#balance_content').html('<i style="color: red;">' + JSON.stringify(errorThrown) + '</i>') ;
                //$('#openmodal').trigger('click');
            }
        });

    }

    $('#amount_transfert').change(function () {
        $('#residual_amount_transfert').html(parseFloat(this.max) - parseFloat(this.value));
        $('#choosen_amount_transfert').html(parseFloat(this.value));
    });




    function filterPossibleTenant(username) {


        //alert (username);

        $.ajax({
            async:true,
            beforeSend:function(jqXHR, settings){
                $('#groupLoader').show();
                //alert(this.url);
                //console.log(this.url);
            },
            complete:function(jqXHR ,textStatus){
                $('#groupLoader').hide();
            },
            dataType: "json",
            error:function(jqXHR, textStatus,errorThrown){
                $('#groupLoader').hide();
                //alert(errorThrown.toString());
            },
            url: '<?php echo e(url('')); ?>/tenants-that-matches-username/'+username,
            data: '',
            success: function (data) {
                console.log(JSON.stringify(data.response));
               if(data.success == 1 && data.faillure == 0){

                   if(data.response.length === 1){


                       var options_string = '<option value=""></option>';
                       for (var i=0 ; i<data.response.length; i++){
                           options_string += '<option value="'+data.response[i].tenant+'">'+data.response[i].tenant_name+'</option>';
                       }
                       $('#tenantid').html(options_string);
                       document.getElementById('login_button').disabled = false;





                   }else if (data.response.length > 1){

                       var options_string = '<option value=""></option>';
                       for (var i=0 ; i<data.response.length; i++){
                           options_string += '<option value="'+data.response[i].tenant+'">'+data.response[i].tenant_name+'</option>';
                       }
                       $('#tenantid').html(options_string);
                       document.getElementById('login_button').disabled = false;

                   }else {
                       document.getElementById('login_button').disabled = true;
                   }

                }
            }
        });
    }


    function login(loginForm) {

        console.log("ENTREEEEEE222222222: \n\n" +loginForm.getElementById('tenantid').value);


    }


    function addReductionFactor() {


        var numfactors = $('#reduction_factors > div.row').length;


        var innerHtml = '<div class="row">\n' +
            '                                        <div class="col-md-12">\n' +
            '                                            <div cclass="form-group">\n' +
            '                                                <label  class="dot pull-left" style="text-align: center;margin-left: 15px;">'+ numfactors + '</label>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '\n' +

            '\n' +
            '                                    <div class="col-md-5">\n' +
            '                                        <div class="form-group" style="text-align: left;">\n' +
            '                                            <label for="reductionfactor'+(numfactors - 1)+'">Facteur</label>\n' +
            '                                            <input type="text" class="form-control form-control-text" name="reductionfactor'+(numfactors - 1) +'" id="reductionfactor'+(numfactors-1)+'" placeholder="Facteur" />\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '\n' +
            '                                    <div class="col-md-3">\n' +
            '                                        <div class="form-group" style="text-align: left;">\n' +
            '                                            <label for="lowerbound'+(numfactors - 1 )+'">De</label>\n' +
            '                                                <input type="number" class="form-control form-control-text" name="lowerbound'+(numfactors - 1 )+
            '" id="lowerbound'+(numfactors - 1 )+'" placeholder="Borne Inf." />\n' +
            '\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-md-3">\n' +
            '                                        <div class="form-group" style="text-align: left;">\n' +
            '                                            <label for="upperbound'+(numfactors - 1 )+'">A</label>\n' +
            '                                                <input type="number" class="form-control form-control-text" name="upperbound'+(numfactors - 1 )+'" id="upperbound'+(numfactors - 1 )+'" placeholder="Borne Sup."/>\n' +
            '\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-md-1">\n' +
            '<br><button class="btn btn-link" onclick="removeReductionFactor(this, \'reduction_factors\'); return false;" style="font-size: medium;" title="Remove Phase ">&times;</button>\n' +
            '                                        </div>'+
            '                                </div>' +
            '\n';

        $('#addreductionfactorsgroup').before(innerHtml);

    }


    function removeReductionFactor(target, id) {
        var row = target.parentElement.parentElement;
        row.parentElement.removeChild(row);

        $('#' + id +' .dot').each(function (index) {
            if (!($('#' + id +' .dot').length -1 === index))
                $(this).html((index+1));
        });
    }


</script>







</body>
</html>
