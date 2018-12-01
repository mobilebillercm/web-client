@extends('layouts.app')
@section('title', 'MOBILEBILEER/SIGNUP')
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
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-10">
                                <div class="">
                                    <div class="" style="color: #3db4e1; border-radius: 8px;">
                                        <div class="" style="width: 100%; padding: 15px; border-radius: 8px;">
                                            <form class="form-style-9 validate-form" method="post" action="{{url('id/signup')}}"
                                            enctype="multipart/form-data">
                                                <span class="login100-form-logo">
                                                    <i class="fa fa-user-plus"></i>
                                                </span>
                                                <span class="login100-form-title p-b-34 p-t-27">
                                                    <h4>S'enregistrer</h4>
                                                </span>
                                                <hr style="margin-top: -20px; width: 75%; margin-left: auto; margin-right: auto;"> <br>

                                                @if(session('message') and session('message')['result']['success'] === 1 and session('message')['result']['faillure'] === 0)
                                                    <div class="alert-success">{{session('message')['result']['response']}}</div>
                                                    <br>
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
                                                            <br>

                                                        <?php
                                                        ?>
                                                    @else
                                                        <div class="alert-danger">{{session('message')['result']['raison']}}</div>
                                                    @endif
                                                @endif
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="tenantname" style="font-size: 16px;">Entreprise <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="tenantname" id="tenantname"
                                                                   placeholder="Enter le nom de l'entreprise"
                                                                   style="color: #0d0d0d;"
                                                                   /> <br>
                                                        </div>
                                                        {{--<div class="wrap-input100 validate-input" data-validate="Enter Enterprise Name">

                                                            <input class="input100" type="text" name="tenantname" placeholder=""">
                                                            <span class="focus-input100" data-placeholder="Entreprise ">
                                                    </span>
                                                        </div>--}}
                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="tenantdescrition" style="font-size: 16px;">Description <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="tenantdescrition" id="tenantdescrition"
                                                                   placeholder="Description de l'entreprise"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>
                                                        {{--<div class="wrap-input100 validate-input" data-validate="Enter Description" >
                                                            <textarea class="input100" name="tenantdescrition" placeholder=""></textarea>
                                                            <span class="focus-input100" data-placeholder="Description"></span>
                                                        </div>--}}
                                                    </div>
                                                </div>
						
						        <div class="row">
                                                    <div class="col-md-6">


                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="taxpayernumber" style="font-size: 16px;">Numero de contribuable <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="taxpayernumber" id="taxpayernumber"
                                                                   placeholder="Numero de contribuable"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>


                                                        {{--<div class="wrap-input100 validate-input" data-validate="Numero de contribuable">
                                                            <input class="input100" type="text" name="taxpayernumber" placeholder="" >
                                                            <span class="focus-input100" data-placeholder="Numero de contribuable ">
                                                    </span>
                                                        </div>--}}
                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="numbertraderegister" style="font-size: 16px;">Numero de Registre de Commerce <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="numbertraderegister" id="numbertraderegister"
                                                                   placeholder="Numero de Registre de Commerce"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>


                                                       {{-- <div class="wrap-input100 validate-input" data-validate="Nomero de Registre de Commerce">
                                                            <input class="input100" type="text" name="numbertraderegister" placeholder="" >
                                                            <span class="focus-input100" data-placeholder="Nomero de Registre de Commerce">
                                                    </span>
                                                        </div>--}}
                                                    </div>
                                                </div>

                                                <div class="row">


                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="administratorlastname" style="font-size: 16px;">Nom du Representant <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="administratorlastname" id="administratorlastname"
                                                                   placeholder="Nom"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="administratorfirstname" style="font-size: 16px;">Prenom du Representant<b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="administratorfirstname" id="administratorfirstname"
                                                                   placeholder="Prenom"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>

                                                    </div>
                                                </div>
							
                                                <div class="row">




                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="administratoremail" style="font-size: 16px;">E-Mail du Representant<b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="administratoremail" id="administratoremail"
                                                                   placeholder="E-Mail du Representant"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>
                                                        {{--<div class="wrap-input100 validate-input" data-validate="Enter A Valid E-Mail" >
                                                            <input class="input100" type="email" name="administratoremail" placeholder="">
                                                            <span class="focus-input100" data-placeholder="E-Mail"></span>
                                                        </div>--}}
                                                    </div>
                                                    <div class="col-md-6">


                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="administratorphone" style="font-size: 16px;">Telephone du Representant <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="administratorphone" id="administratorphone"
                                                                   placeholder="Telephone du Representant"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>
                                                       {{-- <div class="wrap-input100 validate-input" data-validate="Enter a Valid phone number">
                                                            <input class="input100" type="tel" name="administratorphone" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Telephone"></span>
                                                        </div>--}}
                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="adminitratorpassword" style="font-size: 16px;">Mot de Passe <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="adminitratorpassword" id="adminitratorpassword"
                                                                   placeholder="Mot de Passe"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>
                                                        {{--<div class="wrap-input100 validate-input" data-validate="Password Error">
                                                            <input class="input100" type="password" name="adminitratorpassword" placeholder="" >
                                                            <span class="focus-input100" data-placeholder="Mot de Passe"></span>
                                                        </div>--}}
                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="adminitratorpassword_confirmation" style="font-size: 16px;">Confirmer le mot de passe <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="adminitratorpassword_confirmation" id="adminitratorpassword_confirmation"
                                                                   placeholder="Mot de Passe"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>
                                                        {{--<div class="wrap-input100 validate-input" data-validate="Password Confirmation Error">
                                                            <input class="input100" type="password" name="adminitratorpassword_confirmation" placeholder="" >
                                                            <span class="focus-input100" data-placeholder="Confirmer le mot de passe"></span>
                                                        </div>--}}
                                                    </div>

                                                    <div class="col-md-6">


                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="tenantcity" style="font-size: 16px;">Ville <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="tenantcity" id="tenantcity"
                                                                   placeholder="Ville"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>
                                                        {{--<div class="wrap-input100 validate-input" data-validate="Entrer une Ville">
                                                            <input class="input100" type="text" name="tenantcity" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Ville"></span>
                                                            <input type="hidden" name="primarycontrycode" value="CM">
                                                            <input type="hidden" name="primarydialingcontrycode" value="00237">
                                                            <input type="hidden" name="secondarycontrycode" value="CM">
                                                            <input type="hidden" name="secondarydialingcontrycode" value="00237">
                                                            <input type="hidden" name="addressstreetadresse" value="Douala">
                                                            <input type="hidden" name="addresscountrycode" value="CM">
                                                            <input type="hidden" name="addresspostalcode" value="80209">
                                                        </div>--}}
                                                    </div>

                                                    <input type="hidden" name="primarycontrycode" value="CM">
                                                    <input type="hidden" name="primarydialingcontrycode" value="00237">
                                                    <input type="hidden" name="secondarycontrycode" value="CM">
                                                    <input type="hidden" name="secondarydialingcontrycode" value="00237">
                                                    <input type="hidden" name="addressstreetadresse" value="Douala">
                                                    <input type="hidden" name="addresscountrycode" value="CM">
                                                    <input type="hidden" name="addresspostalcode" value="80209">

                                                    <div class="col-md-6">


                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="tenantregion" style="font-size: 16px;">Region <b style="color: red;" class=""> *</b></label>
                                                            <input type="text" class="form-control form-control-text" required
                                                                   name="tenantregion" id="tenantregion"
                                                                   placeholder="Region"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>
                                                        {{--<div class="wrap-input100 validate-input" data-validate="Entrer la Region">
                                                            <input class="input100" type="text" name="tenantregion" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Region"></span>
                                                        </div>--}}
                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group" style="text-align: left;">
                                                            <label for="tenantlogo" style="font-size: 16px;">Logo <b style="color: red;" class=""> *</b></label>
                                                            <input type="file" class="form-control form-control-text" required
                                                                   name="tenantlogo" id="tenantlogo"
                                                                   placeholder="Logo"
                                                                   style="color: #0d0d0d;"
                                                            /> <br>
                                                        </div>
                                                        {{--<div class="wrap-input100 validate-input" data-validate="Enter A Valid file">
                                                            <input class="input100" type="file" name="tenantlogo" placeholder="" style="margin-left: 40px; margin-top: 30px;">
                                                            <span class="focus-input100" data-placeholder="Logo"></span>
                                                        </div>--}}
                                                    </div>
                                                </div>




                                                <div class="container-login100-form-btn">
                                                    <button class="login100-form-btn-blue">
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
