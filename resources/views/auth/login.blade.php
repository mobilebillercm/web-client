@extends('layouts.app')
@section('title', 'MOBILEBILEER/LOGIN')
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
                                                <form class="form-style-9 validate-form" method="post" action="{{url('id/login')}}">
                                                <span class="login100-form-logo">
                                                    <i class="fa fa-sign-in"></i>
                                                </span>

                                                    <span class="login100-form-title p-b-34 p-t-27">
                                                    <h4>Login</h4>
                                                </span>

                                                    <hr style="margin-top: -20px; width: 75%; margin-left: auto; margin-right: auto;"> <br>
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
                                                                    //echo  var_dump($jsonObj); exit();
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

                                                    <div class="form-group" style="text-align: left;">
                                                        <label for="email" style="font-size: 16px;">E-mail/Username <b style="color: red;" class=""> *</b></label>
                                                        <input type="text" class="form-control form-control-text" required
                                                               name="email" id="email"
                                                               placeholder="Enter E-mail/Username"
                                                               style="color: #0d0d0d;"
                                                               onblur="filterPossibleTenant(this.value);"/> <br>
                                                    </div>

                                                   {{-- <div class="wrap-input100 validate-input" data-validate = "Enter a Valid E-mail">
                                                        <input class="input100" type="text" name="email" placeholder="" style="font-family: Poppins-Medium;" onblur="filterPossibleTenant(this.value);">
                                                        <span class="focus-input100" data-placeholder="E-Mail"></span>
                                                    </div>--}}

                                                    <div class="form-group" style="text-align: left; display: none;" id="tenant_drop_down">
                                                        <select name="tenantid" id="tenantid" class="form-control form-control-text"
                                                                style="color: #0d0d0d; ">
                                                                <option value="">---Choisir l'entreprise ---</option>
                                                        </select>
                                                        <br>
                                                    </div>

                                                    {{--<div class="wrap-input100 validate-input">
                                                        <select id="tenantid" name="tenantid" class="input100" value="test">
                                                        </select>
                                                        <span class="focus-input100" data-placeholder="Entreprise"></span>
                                                    </div>--}}


                                                    <div class="form-group" style="text-align: left;">
                                                        <label for="password" style="font-size: 16px;">Mot de passe <b style="color: red;" class=""> *</b></label>
                                                        <input type="password" class="form-control form-control-text" required
                                                               name="password" id="password"
                                                               placeholder="Enter Mot de passe"
                                                               autocomplete="off"
                                                               style="color: #0d0d0d;"
                                                              /> <br>
                                                    </div>

                                                   {{-- <div class="wrap-input100 validate-input" data-validate="Enter password">
                                                        <input class="input100" type="password" name="password" placeholder="" style="font-family: Poppins-Medium;">
                                                        <span class="focus-input100" data-placeholder="Password"></span>
                                                    </div>--}}



                                                  {{--  <div class="contact100-form-checkbox">
                                                        <label  for="ckb1">
                                                            <input  id="ckb1" type="checkbox" name="remember-me"
                                                                    style="height: 20px; width: 20px; background: #FFFFFF; color: #FFFFFF;"> &nbsp; &nbsp;
                                                            <span class="" style="color: white; font-size: medium;">Remember </span>
                                                        </label>
                                                    </div>--}}

                                                    <div class="container-login100-form-btn">
                                                            <button class="login100-form-btn-blue" id="login_button" type="submit">

                                                            Login
                                                        </button>
                                                    </div>



                                                    <div class="text-center">
                                                        <a class="pull-left" href="{{url('id/reset-password')}}" >
                                                            <b style="color: #3db4e1">Mot de Passe Oublie?</b>
                                                        </a>
                                                        <a href="{{url('id/signup')}}" class="pull-right txt1">
                                                            <b style="color: #3db4e1"> S'enregistrer </b>
                                                        </a>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <br>

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
