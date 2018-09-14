@extends('layouts.app')
@section('title', 'MOBILEBILEER/LOGIN')
@section('commonsection')
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="main_home">
                <div class="home_text">

                        <div class="main_home">
                            <div class="limiter">
                                <div class="container-login100" style="background-image: url('{{asset('images/header.jpg')}}');">
                                    <div class="wrap-login100">
                                        <form class="login100-form validate-form" method="post" action="{{url('login')}}">
					<span class="login100-form-logo">
						<i class="fa fa-sign-in"></i>
					</span>

                                            <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

                                            @csrf
                                            <div class="wrap-input100 validate-input" data-validate = "Enter username">
                                                <input class="input100" type="text" name="email" placeholder="" style="font-family: Poppins-Medium;">
                                                <span class="focus-input100" data-placeholder="E-Mail"></span>
                                            </div>

                                            <div class="wrap-input100 validate-input" data-validate="Enter password">
                                                <input class="input100" type="password" name="password" placeholder="" style="font-family: Poppins-Medium;">
                                                <span class="focus-input100" data-placeholder="Password"></span>
                                            </div>

                                            <div class="contact100-form-checkbox">
                                                <label  for="ckb1">
                                                    <input  id="ckb1" type="checkbox" name="remember-me"
                                                            style="height: 20px; width: 20px; background: #FFFFFF;"> &nbsp; &nbsp;
                                                    <span class="" style="color: white; font-size: medium;">Remember </span>
                                                </label>
                                            </div>

                                            <div class="container-login100-form-btn">
                                                <button class="login100-form-btn">
                                                    Login
                                                </button>


                                            </div>

                                            <div class="text-center p-t-90">
                                                <a class="txt1 pull-left" href="{{url('password-forgot')}}">
                                                    Mot de Passe Oublie?
                                                </a>
                                                <a href="{{url('signup')}}" class="pull-right txt1">S'enregistrer</a>
                                            </div>
                                        </form>
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