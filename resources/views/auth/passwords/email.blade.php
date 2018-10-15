@extends('layouts.app')
@section('title', 'MOBILEBILEER/RESET/PASSWORD')
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
                                    <form class="login100-form validate-form">
					<span class="login100-form-logo">
						<i class="fa fa-sign-in"></i>
					</span>

                                        <span class="login100-form-title p-b-34 p-t-27">
						Mail de Reconfiguration de Mot de Passe
					</span>

                                        @csrf
                                        <div class="wrap-input100 validate-input" data-validate = "Enter E-Mail">
                                            <input class="input100" type="email" name="email" placeholder="" style="font-family: Poppins-Medium;">
                                            <span class="focus-input100" data-placeholder="E-Mail"></span>
                                        </div>

                                        <div class="container-login100-form-btn">
                                            <button class="login100-form-btn">
                                                Envoyer
                                            </button>


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