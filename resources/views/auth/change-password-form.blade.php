@extends('layouts.app')
@section('title', 'MOBILEBILEER/SERVICES')
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
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="">
                                    <div class="" style="color: #3db4e1; border-radius: 8px;">
                                        <div class="" style="width: 100%; padding: 15px; border-radius: 8px;">
                                            <form class="form-style-9" method="post" action="{{url('id/change-password')}}" id="form-topup">
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    <span class="login100-form-title p-b-34 p-t-27" style="color: #3db4e1;">
                                                        <input type="hidden" name="userid" value="{{\Illuminate\Support\Facades\Auth::user()->userid}}">
                                                        <input type="hidden" name="tenantid" value="{{\Illuminate\Support\Facades\Auth::user()->tenant}}">

                                                        M<span style="text-transform: lowercase;">odifiez Votre Mot De Passe</span>
                                                        <h4>{{\Illuminate\Support\Facades\Auth::user()->firstname.' ' . \Illuminate\Support\Facades\Auth::user()->lastname}}</h4>
                                                    </span>
                                                    @csrf
                                                    @if(session('message') and session('message')['result']['success'] === 1 and session('message')['result']['faillure'] === 0)
                                                        <div class="alert-success">{{session('message')['result']['response']}}</div>
                                                    @else
                                                        @if(session('message') and session('message')['result']['success'] === 0 and session('message')['result']['faillure'] === 1)
                                                            <?php
                                                            $jsonObj = json_decode(session('message')['result']['raison'], true);
                                                            ?>
                                                            <div class="alert-danger">
                                                                <ul class="list-group">
                                                                    <?php
                                                                    if ($jsonObj == null or is_string($jsonObj)) {
                                                                        echo '<li class="list-group-item">' . session('message')['result']['raison'] . '</li>';
                                                                    } else {
                                                                    foreach ($jsonObj as $key => $value) {
                                                                    ?>

                                                                    <li class="list-group-item">{{$value[0]}}</li>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                            <?php
                                                            ?>
                                                        @else
                                                            <div class="alert-danger">{{session('message')['result']['raison']}}</div>
                                                        @endif
                                                    @endif


                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="information-account" id="" style="display: block;" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="oldpassword" style="font-size: 16px;"> Mot de Passe Courante<b style="color: red;" class=""> *</b></label>
                                                                            <input type="password" class="form-control form-control-text" required name="oldpassword" id="oldpassword"
                                                                                   placeholder="Mot de Passe Actuel"
                                                                                   style="color: #0d0d0d;" />
                                                                             <br>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="newpassword" style="font-size: 16px;"> Nouveau Mot de Passe<b style="color: red;" class=""> *</b></label>
                                                                            <input type="password" class="form-control form-control-text" required name="newpassword" id="newpassword"
                                                                                   placeholder="Nouveau Mot de Passe "
                                                                                   style="color: #0d0d0d;" /> <br>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="newpasswordconfirmation" style="font-size: 16px;"> Confirmer Nouveau Mot de Passe<b style="color: red;" class=""> *</b></label>
                                                                            <input type="password" class="form-control form-control-text" required name="newpasswordconfirmation"
                                                                                   id="newpasswordconfirmation"
                                                                                   placeholder="Confirmation Nouveau Mot de Passe"
                                                                                   style="color: #0d0d0d;" /><br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="container-login100-form-btn">
                                                                            <button class="login100-form-btn-blue" type="submit" onclick="submitFormTopup();">
                                                                                Charger
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <br><br>

                                                @else
                                                    <div class="container-login100-form-btn">
                                                        <a href="{{url('id/signup')}}" class="btn btn-outline-info btn-lg login100-form-btn-blue">S'enregistrer</a>
                                                    </div>
                                                @endif


                                            </form>

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
