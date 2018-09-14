@extends('layouts.app')
@section('title', 'MOBILEBILEER/SIGNUP')
@section('commonsection')
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="main_home">
                <div class="home_text">

                    <div class="main_home">
                        <div class="limiter">
                            <div class="container-login100"
                                 style="background-image: url('{{asset('images/header.jpg')}}');">
                                <div class="wrap-login100" style="width: 800px;">
                                    <form class="login100-form validate-form">
					<span class="login100-form-logo">
						<i class="fa fa-user-plus"></i>
					</span><span class="login100-form-title p-b-34 p-t-27">Sign Up</span>

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
                                                <div class="wrap-input100 validate-input" data-validate="Enter Last Name">
                                                    <textarea class="input100" name="lastname" placeholder=""></textarea>
                                                    <span class="focus-input100" data-placeholder="Description"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="wrap-input100 validate-input" data-validate="Enter First Name">
                                                    <input class="input100" type="text" name="repfirstname" placeholder="">
                                                    <span class="focus-input100" data-placeholder="Nom"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="wrap-input100 validate-input" data-validate="Enter Last Name">
                                                    <input class="input100" type="text" name="replastname" placeholder="">
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
                                                <div class="wrap-input100 validate-input" data-validate="Enter A Valid file">
                                                    <input class="input100" type="file" name="logo" placeholder="">
                                                    <span class="focus-input100" data-placeholder="Logo"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="wrap-input100 validate-input" data-validate="Enter a Valid phone number">
                                                    <input class="input100" type="tel" name="phone1" placeholder="">
                                                    <span class="focus-input100" data-placeholder="Tel 1"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="wrap-input100 validate-input" data-validate="Enter a Valid phone number">
                                                    <input class="input100" type="tel" name="phone2" placeholder="">
                                                    <span class="focus-input100" data-placeholder="Tel 2"></span>
                                                </div>
                                                <input type="hidden" name="primarycontrycode" value="CM">
                                                <input type="hidden" name="primarydialingcontrycode" value="00237">
                                                <input type="hidden" name="secondarycontrycode" value="CM">
                                                <input type="hidden" name="secondarydialingcontrycode" value="00237">
                                                <input type="hidden" name="addressstreetadresse" value="Douala">
                                                <input type="hidden" name="addresscountrycode" value="CM">
                                                <input type="hidden" name="addresspostalcode" value="80209">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="wrap-input100 validate-input" data-validate="Enter a City">
                                                    <input class="input100" type="text" name="city" placeholder="">
                                                    <span class="focus-input100" data-placeholder="Ville"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="wrap-input100 validate-input" data-validate="Enter Province">
                                                    <input class="input100" type="text" name="province" placeholder="">
                                                    <span class="focus-input100" data-placeholder="Region"></span>
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


                        <div id="dropDownSelect1"></div>
                    </div>

                </div>

                <div class="home_btns m-top-40">

                </div>


            </div>
        </div><!--End off row-->
    </div><!--End off container -->
@endsection