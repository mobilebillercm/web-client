@extends('layouts.app')
@section('title', 'MOBILEBILEER/SIGNUP')
@section('commonsection')
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="main_home">
                <div class="home_text">

                    <div class="main_home">
                        <br><br><br>
                        {{--<div class="limiter">
                            <div class="container-login100">--}}

                        <div class="row">
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-10">
                                <ul class="list-group menu-transaction" style="width: 100%;">
                                    <li class="list-group-item list-group-item-primary primaire" >
                                        <h5 style="font-weight: bold; width: 100%; ">Options</h5>
                                    </li>
                                    <li class=""  style="text-align: center;">
                                        <span class="login100-form-logo" id="balance_content"
                                              style="font-size: 15px; font-weight: bold; width: 112px; height: 112px; color: #225274; text-align: center;">
                                            Solde<br>{{$balance}}<br>

                                        </span>
                                        <a href="#" onclick=" getBalancewithNiceLoader('{{\Illuminate\Support\Facades\Auth::user()->email}}') ; return false;" title="Rafraichir"
                                           style="display: block; font-weight: bold; font-size: 30px; color: #225274; position: absolute; top: 67%; left: 49%;">
                                            <i class="fa fa-refresh" style="color: #225274;"></i>
                                        </a>
                                        <img src="{{asset('/assets/images/blue_loading.gif')}}" height="112" width="112" id="balance-loader"
                                             style="display: none; font-weight: bold; font-size: 30px; color: #225274; position: absolute; top: 28%; left: 44%;">

                                    </li>


                                </ul>
                            </div>
                            <div class="col-md-1">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-5">
                                <ul class="list-group menu-transaction" style="width: 100%;">
                                    <li class="list-group-item">
                                        <a  href="{{url('wallet/topup/'.\Illuminate\Support\Facades\Auth::user()->email)}}">Recharger mon Compte</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a  href="{{'wallet/topup'}}">Un de mes sous Comptes</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <ul class="list-group menu-transaction" style="width: 100%;">

                                    <li class="list-group-item">
                                        <a  href="{{'wallet/mobilebillercreditaccounttransactions/2'}}">Un Autre compte</a>
                                    </li>

                                    <li class="list-group-item">
                                        <a  href="{{'wallet/mobilebillercreditaccounttransactions/3'}}">Transfere</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-md-1">

                            </div>
                        </div>

                            {{--</div>
                        </div>--}}


                        <div id="dropDownSelect1"></div>
                    </div>

                </div>

                <div class="home_btns m-top-40">

                </div>


            </div>
        </div><!--End off row-->
    </div><!--End off container -->
@endsection
