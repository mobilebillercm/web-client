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
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-10">
                                <div class="">
                                    <div class="" style="color: #3db4e1; border-radius: 8px;">
                                        <div class="" style="width: 100%; padding: 15px; border-radius: 8px;">
                                            <form class="form-style-9" method="post" action="{{url('wallet/cash-topups')}}" id="form-topup">
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    <span class="login100-form-title p-b-34 p-t-27" style="color: #3db4e1;">
                                                       {{-- <h5>Beneficiaire: {{$beneficiary->firstname}} {{$beneficiary->lastname}}</h5>--}}
                                                        <input type="hidden" name="userid" value="{{\Illuminate\Support\Facades\Auth::user()->userid}}">
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


                                                    <div class="row">
                                                        <div class="col-md-1">

                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="information-account" id="" style="display: block;" >
                                                                <div class="row">
                                                                    {{-- <div class="col-md-12">
                                                                         <br>
                                                                         <h4>Information du Compte</h4>
                                                                         <hr class="ligne">
                                                                     </div>--}}
                                                                    {{--<input type="hidden" name="beneficiary" value="{{$beneficiary->userid}}">--}}

                                                                    <div class="col-md-4">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="entreprise" style="font-size: 16px;"> Entreprise<b style="color: red;" class=""> *</b>
                                                                                <img src="{{asset('/assets/images/blue_loading.gif')}}" height="25" width="25" id="benefiary-loader"
                                                                                     style="display: none;">
                                                                            </label>
                                                                            <select class="form-control form-control-text" required name="entreprise" id="entreprise"

                                                                                    style="color: #0d0d0d;" onchange="loadBenefiaryByTenant(this.value);"
                                                                            onclick="loadBenefiaryByTenant(this.value);">
                                                                                <option value="">--- Selectionner une Entreprise ---</option>
                                                                                @foreach($tenants as $tenant)
                                                                                    <option value="{{$tenant->tenantid}}">{{$tenant->name}}</option>
                                                                               @endforeach
                                                                            </select> <br>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="beneficiary" style="font-size: 16px;">Beneficiaire <b style="color: red;" class=""> *</b></label>
                                                                            <select class="form-control form-control-text" required name="beneficiary" id="beneficiary"

                                                                                    style="color: #0d0d0d;" >
                                                                                <option value="">---Beneficiare---</option>

                                                                            </select>
                                                                            <br>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="amount" style="font-size: 16px;">Montant de recharge <b style="color: red;" class=""> *</b></label>
                                                                            <input type="number" class="form-control form-control-text" required name="amount" id="amount"
                                                                                   placeholder="Montant de la recharge"
                                                                                   style="color: #0d0d0d;" /> <br>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4>Methode de Paiement</h4>
                                                            <hr class="ligne">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="containerradio" id="payment_methode11"
                                                                   onclick="exchangeVisibility('mobilemoneyform', 'creditcardform', 'mobilebillercreditaccountform');"
                                                                   style="font-size: 16px;">
                                                                Mobile Money <small style="font-size: x-small">(MTN MObile Money, Orange Money, ...)</small>
                                                                <input type="radio" checked="checked" name="payment_methode" id="payment_methode1">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="containerradio" id="payment_methode22"
                                                                   onclick="exchangeVisibility('creditcardform', 'mobilemoneyform', 'mobilebillercreditaccountform');"
                                                                   style="font-size: 16px;">Credit Card <small style="font-size: x-small;">(VISA, MAESTRO, MASTER, PAYPAL, etc.)</small>
                                                                <input type="radio"  name="payment_methode" id="payment_methode2">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>


                                                        @if(\Illuminate\Support\Facades\Auth::user()->userid === env('SUPER_ADMINISTRATOR_ID'))
                                                            <div class="col-md-4">
                                                                <label class="containerradio" id="payment_methode33"
                                                                       onclick="exchangeVisibility('cashform', 'mobilemoneyform', 'creditcardform'); setPaymentMethodTypeId('a6ba8bb6-b960-11e8-8c3b-ac2b6ee888a2');"
                                                                       style="font-size: 16px;">Cash <small style="font-size: x-small;"></small>
                                                                    <input type="radio"  name="payment_methode" id="payment_methode3">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        @endif

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-1">

                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="information-account" id="mobilemoneyform" style="display: none;" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <h4>Information du Compte</h4>
                                                                        <hr class="ligne">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            @foreach(session('paymentmethodtypes')  as $paymentmethodtype)
                                                                                @if($paymentmethodtype->type == 'MOBILEMONEY')
                                                                                    <div class="col-md-6">
                                                                                        <label class="containerradio" style="font-size: 16px;"
                                                                                               onclick="setPaymentMethodTypeAndIssuer('{{$paymentmethodtype->b_id}}', '{{$paymentmethodtype->provider}}');">{{$paymentmethodtype->name}}</small>
                                                                                            <input type="radio" checked="checked" name="paymentmethodtype" id="{{$paymentmethodtype->b_id}}"
                                                                                                   value="{{$paymentmethodtype->b_id}}">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                            {{--<div class="col-md-6">
                                                                                <label class="containerradio" style="font-size: 16px;">Orange Money</small>
                                                                                    <input type="radio"  name="numbertype" id="numbertype_orange">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>--}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="phonenumber" style="font-size: 16px;">Numero <b style="color: red;" class=""> *</b></label>
                                                                            <input type="tel" class="form-control form-control-text" required name="phonenumber" id="phonenumber"
                                                                                   placeholder="Numero du Compte Mobile Money"  value="{{session('phase1')?session('data')['phonenumber']:''}}"
                                                                                   style="color: #0d0d0d;" /> <br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="holder" style="font-size: 16px;">Titulaire <b style="color: red;" class=""> *</b></label>
                                                                            <input type="text" class="form-control form-control-text" required name="holder" id="holder"
                                                                                   placeholder="Titulaire du Numero Mobile Money"  value="{{session('data')?session('data')['holder']:''}}"
                                                                                   style="color: #0d0d0d;"/> <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-1">

                                                        </div>
                                                        <div class="col-md-10">
                                                            <div  id="creditcardform" style="display: none;" class="information-account">
                                                                <div class="row" >
                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <h4>Information du Compte</h4>
                                                                        <hr class="ligne">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="row">

                                                                            @foreach(session('paymentmethodtypes')  as $paymentmethodtype)
                                                                                @if($paymentmethodtype->type == 'CREDITCARD')
                                                                                    <div class="col-md-2">
                                                                                        <label class="containerradio" style="font-size: 16px;"
                                                                                               onclick="setPaymentMethodTypeAndIssuer('{{$paymentmethodtype->b_id}}', '{{$paymentmethodtype->provider}}');">{{$paymentmethodtype->name}}</small>
                                                                                            <input type="radio" checked="checked" name="paymentmethodtype" id="{{$paymentmethodtype->b_id}}"
                                                                                                   value="{{$paymentmethodtype->b_id}}">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                            {{--<div class="col-md-2">
                                                                                <label class="containerradio" style="font-size: 16px;">Master</small>
                                                                                    <input type="radio"  name="cardtype" id="cardtype_master">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label class="containerradio" style="font-size: 16px;">Paypal</small>
                                                                                    <input type="radio"  name="cardtype" id="cardtype_paypal">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label class="containerradio" style="font-size: 16px;">Maestro</small>
                                                                                    <input type="radio"  name="cardtype" id="cardtype_maestro">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label class="containerradio" style="font-size: 16px;">PostPay</small>
                                                                                    <input type="radio"  name="cardtype" id="cardtype_postpay">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label class="containerradio" style="font-size: 16px;">Carte Bleue</small>
                                                                                    <input type="radio"  name="cardtype" id="cardtype_cartebleue">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>--}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="cardnumber" style="font-size: 16px;">Numero decarte <b style="color: red;" class=""> *</b></label>
                                                                            <input type="text" class="form-control form-control-text" required name="cardnumber" id="cardnumber"
                                                                                   placeholder="Numero de carte de credit"  value="{{session('phase1')?session('data')['cardnumber']:''}}"
                                                                                   style="color: #0d0d0d;"/>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="cardholder" style="font-size: 16px;">Titulaire <b style="color: red;" class=""> *</b></label>
                                                                            <input type="text" class="form-control form-control-text" required name="cardholder" id="cardholder"
                                                                                   placeholder="Titulaire du Numero Mobile Money"  value="{{session('data')?session('data')['holder']:''}}"
                                                                                   style="color: #0d0d0d;"/>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="expired_date" style="font-size: 16px;">Date d'expiration <b style="color: red;" class=""> *</b></label>
                                                                            <input type="month" class="form-control form-control-text" required name="expired_date" id="expired_date"
                                                                                   placeholder="Date d'expiration"  value=""
                                                                                   style="color: #0d0d0d;"/>
                                                                            <br>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="securitycode" style="font-size: 16px;">Code de Securite <b style="color: red;" class=""> *</b></label>
                                                                            <input type="text" class="form-control form-control-text" required name="securitycode" id="securitycode"
                                                                                   placeholder="Security code"  value=""
                                                                                   style="color: #0d0d0d;"/>
                                                                            <br>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-1">

                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="information-account" id="cashform" style="display: none;" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <h4>Information du Compte</h4>
                                                                        <hr class="ligne">
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div cclass="form-group" style="text-align: left;">
                                                                            <label for="password" style="font-size: 16px;">Confirmer Avec votre Mot de passe <b style="color: red;" class=""> *</b></label>
                                                                            <input type="password" class="form-control form-control-text" required name="password" id="password"
                                                                                   placeholder="Votre Mot de Passe"
                                                                                   style="color: #0d0d0d;" /> <br>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">

                                                        </div>
                                                    </div>


                                                    <br><br>

                                                @else
                                                    <div class="container-login100-form-btn">
                                                        <a href="{{url('id/signup')}}" class="btn btn-outline-info btn-lg login100-form-btn-blue">S'enregistrer</a>
                                                    </div>
                                                @endif
                                                <input type="hidden" name="payment_method_id" id="payment_method_id" value="">
                                                <input type="hidden" name="card_number" id="card_number" value="">
                                                <input type="hidden" name="card_holder" id="card_holder" value="">
                                                <input type="hidden" name="user_id" id="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->userid}}">
                                                <input type="hidden" name="firstname" id="firstname" value="{{\Illuminate\Support\Facades\Auth::user()->firstname}}">
                                                <input type="hidden" name="lastname" id="lastname" value="{{\Illuminate\Support\Facades\Auth::user()->lastname}}">
                                                <input type="hidden" name="username" id="username" value="{{\Illuminate\Support\Facades\Auth::user()->username}}">
                                                <input type="hidden" name="tenantid" id="tenantid" value="{{\Illuminate\Support\Facades\Auth::user()->tenant}}">

                                                <input type="hidden" name="expiry_date" id="expiry_date" value="">
                                                <input type="hidden" name="security_code" id="security_code" value="">
                                                <input type="hidden" name="issuer" id="issuer" value="">
                                                <input type="hidden" name="user_transaction_number" id="user_transaction_number" value="{{time()}}">

                                                <div class="container-login100-form-btn">
                                                    <button class="login100-form-btn-blue" type="submit" onclick="submitFormTopup();">
                                                        Charger
                                                    </button>
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
