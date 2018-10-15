@extends('layouts.app')
@section('title', 'MOBILEBILEER/LOGIN')
@section('commonsection')
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="main_home">
                <div class="home_text">

                        <div class="main_home">
                            <div class="row">
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-8">
                                    <div class="limiter">
                                        <div class="container-login100" >
                                            <div class="wrap-login100" style="width: 100%;">
                                                <form class="login100-form validate-form" method="post" action="{{url('id/login')}}">
					<span class="login100-form-logo">
						<i class="fa fa-sign-in"></i>
					</span>

                                                    <span class="login100-form-title p-b-34 p-t-27">
                                                Login
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

                                                    <div class="wrap-input100 validate-input" data-validate = "Enter a Valid E-mail">
                                                        <input class="input100" type="text" name="email" placeholder="" style="font-family: Poppins-Medium;" onblur="filterPossibleTenant(this.value);">
                                                        <span class="focus-input100" data-placeholder="E-Mail"></span>
                                                    </div>
                                                    <div class="wrap-input100 validate-input">
                                                        <select id="tenantid" name="tenantid" class="input100" value="test">
                                                        </select>
                                                        <span class="focus-input100" data-placeholder="Entreprise"></span>
                                                    </div>

                                                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                                                        <input class="input100" type="password" name="password" placeholder="" style="font-family: Poppins-Medium;">
                                                        <span class="focus-input100" data-placeholder="Password"></span>
                                                    </div>



                                                    <div class="contact100-form-checkbox">
                                                        <label  for="ckb1">
                                                            <input  id="ckb1" type="checkbox" name="remember-me"
                                                                    style="height: 20px; width: 20px; background: #FFFFFF; color: #FFFFFF;"> &nbsp; &nbsp;
                                                            <span class="" style="color: white; font-size: medium;">Remember </span>
                                                        </label>
                                                    </div>

                                                    <div class="container-login100-form-btn">
                                                        <button class="login100-form-btn" id="login_button" type="submit">
                                                            Login
                                                        </button>
                                                    </div>

                                                    <div class="text-center p-t-90">
                                                        <a class="txt1 pull-left" href="{{url('password-forgot')}}">
                                                            Mot de Passe Oublie?
                                                        </a>
                                                        <a href="{{url('id/signup')}}" class="pull-right txt1">S'enregistrer</a>
                                                    </div>
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
