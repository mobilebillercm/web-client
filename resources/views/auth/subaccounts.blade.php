@extends('layouts.app')
@section('title', 'MOBILEBILEER/SUBACCOUNT')
@section('commonsection')
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="main_home">
                <div class="home_text">
                    <div class="main_home">

                        <style>
                            /* The container */
                            .containerradio {
                                display: block;
                                position: relative;
                                padding-left: 35px;
                                margin-bottom: 12px;
                                cursor: pointer;
                                font-size: 22px;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                -ms-user-select: none;
                                user-select: none;
                            }

                            /* Hide the browser's default radio button */
                            .containerradio input {
                                position: absolute;
                                opacity: 0;
                                cursor: pointer;
                            }

                            /* Create a custom radio button */
                            .checkmark {
                                position: absolute;
                                top: 0;
                                left: 0;
                                height: 20px;
                                width: 20px;
                                background-color: #ccc;
                                border-radius: 50%;
                            }

                            /* On mouse-over, add a grey background color */
                            .containerradio:hover input ~ .checkmark {
                                background-color: #b2b2b2;
                            }

                            /* When the radio button is checked, add a blue background */
                            .containerradio input:checked ~ .checkmark {
                                background-color: #4188b1;
                            }

                            /* Create the indicator (the dot/circle - hidden when not checked) */
                            .checkmark:after {
                                content: "";
                                position: absolute;
                                display: none;
                            }

                            /* Show the indicator (dot/circle) when checked */
                            .containerradio input:checked ~ .checkmark:after {
                                display: block;
                            }

                            /* Style the indicator (dot/circle) */
                            .containerradio .checkmark:after {
                                top: 7px;
                                left: 7px;
                                width: 6px;
                                height: 6px;
                                border-radius: 50%;
                                background: white;
                            }






                            a:hover {
                                text-decoration: none;
                                color: #3db4e1;
                            }

                            /*---------------------------------------------*/
                            h1,h2,h3,h4,h5,h6 {
                                margin: 0px;
                            }

                            p {
                                font-family: "DejaVu Sans Light";
                                font-size: 14px;
                                line-height: 1.7;
                                color: #232323;
                                margin: 0px;
                            }

                            ul, li {
                                margin: 0px;
                                list-style-type: none;
                            }


                            /*---------------------------------------------*/
                            /*input {
                                outline: none;
                                border: none;
                            }*/

                            textarea {
                                outline: none;
                                border: none;
                            }

                            textarea:focus, input:focus, select:focus{
                                border-color: #0d0d0d !important;
                            }

                            input:focus::-webkit-input-placeholder { color:transparent; }
                            input:focus:-moz-placeholder { color:transparent; }
                            input:focus::-moz-placeholder { color:transparent; }
                            input:focus:-ms-input-placeholder { color:transparent; }



                            textarea:focus::-webkit-input-placeholder { color:#0d0d0d; }
                            textarea:focus:-moz-placeholder { color:#0d0d0d; }
                            textarea:focus::-moz-placeholder { color:#0d0d0d; }
                            textarea:focus:-ms-input-placeholder { color:#0d0d0d; }

                            input::-webkit-input-placeholder { color: #0d0d0d; }
                            input:-moz-placeholder { color: #0d0d0d; }
                            input::-moz-placeholder { color: #0d0d0d; }
                            input:-ms-input-placeholder { color: #0d0d0d; }


                            /*input[type="file"]::-webkit-input-placeholder { color: black; }
                            input[type="file"]:-moz-placeholder { color: black; }
                            input[type="file"]::-moz-placeholder { color: black; }
                            input[type="file"]:-ms-input-placeholder { color: black; }*/





                            textarea::-webkit-input-placeholder { color: #0d0d0d; }
                            textarea:-moz-placeholder { color: #0d0d0d; }
                            textarea::-moz-placeholder { color: #0d0d0d; }
                            textarea:-ms-input-placeholder { color: #0d0d0d; }

                            /*---------------------------------------------*/
                            button {
                                outline: none !important;
                                border: none;
                                background: transparent;
                            }

                            button:hover {
                                cursor: pointer;
                            }

                            iframe {
                                border: none !important;
                            }
                            .form-control-text{

                                padding: 2px 5px 2px 5px;
                                font-size: large;
                                border-radius: 5px;
                                height: 30px;

                            }
                            label{
                                color: #21769c;
                            }
                            .information-account{

                            }
                        </style>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="">
                                    <div class="" style="color: #3db4e1; border-radius: 8px;">
                                        <div class="" style="width: 100%; padding: 15px; border-radius: 8px;">
                                            <div class="row">

                                                @csrf

                                                <div class="col-md-12">
                                                    @if($subaccounts and (count($subaccounts) > 0))
                                                        <div class="panel panel-primary filterable">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title">Mes Sous Comptes</h3>
                                                                <div class="pull-right">
                                                                    <button class="btn btn-default btn-xs btn-filter"
                                                                            style="height: 25px; border-radius: 5px; margin-top: -8px; text-align: center;">
                                                                        <span class="glyphicon glyphicon-filter" style="margin-top: -7px;"></span> Filter</button>
                                                                </div>
                                                            </div>

                                                            <table class="table">
                                                                <thead>
                                                                <tr class="filters" style="height: 35px;">
                                                                    <th><input type="text" class="form-control form-control-text" placeholder="#" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                    <th><input type="text" class="form-control form-control-text" placeholder="Nom" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                    <th><input type="text" class="form-control form-control-text" placeholder="Prenom" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                    <th><input type="text" class="form-control form-control-text" placeholder="E-Mail" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                    <th><input type="text" class="form-control form-control-text" placeholder="Numero de tel." disabled style="height: 30px; border-radius: 5px;"></th>
                                                                    <th><input type="text" class="form-control form-control-text" placeholder="Etat" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                    <th><input type="text" class="form-control form-control-text" placeholder="Action" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                </tr>
                                                                </thead>

                                                                <?php $num = 1; ?>

                                                                @foreach($subaccounts as $subaccount)
                                                                    <tr style="color: #225274;">
                                                                        <td>{{$num}}</td>
                                                                        <td>{{$subaccount->firstname}}</td>
                                                                        <td>{{$subaccount->lastname}}</td>
                                                                        <td>{{$subaccount->email}}</td>
                                                                        <td>{{$subaccount->phone}}</td>
                                                                        <td>
                                                                            @if($subaccount->enablement == 1)
                                                                                <h4 style="color: forestgreen;">Actif</h4>
                                                                                <img src="{{asset('assets/images/check.png')}}"  height="25" width="25" />
                                                                             @else
                                                                                <h4 style="color: red;">Bloque</h4>
                                                                                <img src="{{asset('assets/images/error.png')}}" height="25" width="25"/>
                                                                            @endif
                                                                        </td>
                                                                        <td>

									   @if($subaccount->enablement == 1)
                                                                                <a href="{{url('id/desable-user/tenant/' . $subaccount->tenantid. '/user/'. $subaccount->userid)}}"
                                                                                style="color: red;" class="desable-user" id="{{$subaccount->userid}}">
                                                                                    <i class="fa fa-remove" style="font-size: 18px; color: #225274;"></i>&nbsp;&nbsp; Bloquer
                                                                                <img src="{{asset('assets/images/loader.gif')}}" style="display: none;" height="25" width="20" 
											id="{{$subaccount->userid}}_desable-user-loader"/>
                                                                                    <span id="{{$subaccount->userid}}_result-desable-user"></span>
                                                                                </a>
                                                                            @else
                                                                                <a href="{{url('id/enable-user/tenant/' . $subaccount->tenantid. '/user/'. $subaccount->userid)}}"
                                                                                   style="color: forestgreen;" class="enable-user" id="_{{$subaccount->userid}}">
                                                                                    <i class="fa fa-check" style="font-size: 18px; color: #225274;"></i>&nbsp;&nbsp; Reactiver
                                                                                    <img src="{{asset('assets/images/loader.gif')}}" style="display: none;" height="25" width="20" 
											id="_{{$subaccount->userid}}_enable-user-loader"/>
                                                                                    <span id="_{{$subaccount->userid}}_result-enable-user"></span>
                                                                                </a>
                                                                            @endif
										
                                                                        </td>
                                                                        <?php $num ++; ?>
                                                                    </tr>
                                                                @endforeach
                                                            </table>

                                                        </div>
                                                    @else
                                                        <div class="alert-danger" style="padding: 15px; text-align: center; font-size: large; color: red; font-weight: bold;">
                                                            <h4 style="font-size: large; color: red; font-weight: bold;">Vous n'avez pas de Sous compte</h4>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="dropDownSelect1"></div>
                    </div>
                </div>
                <div class="home_btns m-top-40">
                </div>
            </div>
        </div><!--End off row-->
    </div><!--End off container -->
@endsection


