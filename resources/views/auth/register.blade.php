@extends('layouts.app')
@section('title', 'MOBILEBILEER/SIGNUP')
@section('commonsection')
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="main_home">
                <div class="home_text">

                    <div class="main_home">
                        <div class="row">
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-10">
                                <div class="limiter">
                                    <div class="container-login100">
                                        <div class="wrap-login100" style="width: 100%;">
                                            <form class="login100-form validate-form" method="post" action="{{url('id/signup')}}"
                                            enctype="multipart/form-data">
					<span class="login100-form-logo">
						<i class="fa fa-user-plus"></i>
					</span><span class="login100-form-title p-b-34 p-t-27">S'enregistrer</span>
                                                <hr style="margin-top: -20px; width: 75%; margin-left: auto; margin-right: auto;"> <br>

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
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter Enterprise Name">

                                                            <input class="input100" type="text" name="tenatname" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Entreprise ">
                                                    </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter Description">
                                                            <textarea class="input100" name="description" placeholder=""></textarea>
                                                            <span class="focus-input100" data-placeholder="Description"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter First Name">
                                                            <input class="input100" type="text" name="firstname" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Nom"></span>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter Last Name">
                                                            <input class="input100" type="text" name="lastname" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Prenom"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter A Valid E-Mail">
                                                            <input class="input100" type="email" name="email" placeholder="">
                                                            <span class="focus-input100" data-placeholder="E-Mail"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter a Valid phone number">
                                                            <input class="input100" type="tel" name="phone" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Telephone"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Password Error">
                                                            <input class="input100" type="password" name="password" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Mot de Passe"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Password Confirmation Error">
                                                            <input class="input100" type="password" name="passwordconfirmation" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Confirmer le mot de passe"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Entrer une Ville">
                                                            <input class="input100" type="text" name="city" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Ville"></span>
                                                            <input type="hidden" name="primarycontrycode" value="CM">
                                                            <input type="hidden" name="primarydialingcontrycode" value="00237">
                                                            <input type="hidden" name="secondarycontrycode" value="CM">
                                                            <input type="hidden" name="secondarydialingcontrycode" value="00237">
                                                            <input type="hidden" name="addressstreetadresse" value="Douala">
                                                            <input type="hidden" name="addresscountrycode" value="CM">
                                                            <input type="hidden" name="addresspostalcode" value="80209">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Entrer la Region">
                                                            <input class="input100" type="text" name="province" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Region"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter A Valid file">
                                                            <input class="input100" type="file" name="logo" placeholder="" style="margin-left: 40px; margin-top: 30px;">
                                                            <span class="focus-input100" data-placeholder="Logo"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- private String tenantName;
                                                 private String tenantDescription;
                                                 private String administorFirstName;
                                                 private String administorLastName;
                                                 private String emailAddress;
                                                 private String primaryTelephone;
                                                 private String secondaryTelephone;
                                                 private String primaryCountryCode;
                                                 private String primaryDialingCountryCode;
                                                 private String secondaryCountryCode;
                                                 private String secondaryDialingCountryCode;
                                                 private String addressStreetAddress;
                                                 private String addressCity;
                                                 private String addressStateProvince;
                                                 private String addressPostalCode;
                                                 private String addressCountryCode;--}}

                                                <div class="container-login100-form-btn">
                                                    <button class="login100-form-btn">
                                                        Enregistrer
                                                    </button>
                                                </div>

                                                <div class="text-center p-t-90">
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
