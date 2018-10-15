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
                                            <form class="login100-form validate-form" method="post" action="{{url('id/invitation')}}">
                                                <span class="login100-form-logo">
                                                    <i class="fa fa-user-plus"></i>
                                                </span>
                                                <span class="login100-form-title p-b-34 p-t-27">Invitation</span>
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


                                                <div class="small" style="text-align: center;">
                                                    {{--<span style="font-size: large; color: white;" class="center">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                    <br>
                                                    <span style="font-size: small; color: white;" class="center">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>--}}
                                                </div>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter First Name">
                                                            <input class="input100" type="text" name="lastname" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Nom"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter Last Name">
                                                            <input class="input100" type="text" name="firstname" placeholder="">
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
                                                            <input class="input100" type="tel" name="phone1" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Tel 1"></span>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter a City">
                                                            <input class="input100" type="text" name="city" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Ville"></span>
                                                            <input type="hidden" name="primarycontrycode" value="CM">
                                                            <input type="hidden" name="primarydialingcontrycode" value="00237">
                                                            <input type="hidden" name="secondarycontrycode" value="CM">
                                                            <input type="hidden" name="secondarydialingcontrycode" value="00237">
                                                            <input type="hidden" name="addressstreetadresse" value="Douala">
                                                            <input type="hidden" name="addresscountrycode" value="CM">
                                                            <input type="hidden" name="addresspostalcode" value="80209">
                                                            <input type="hidden" name="tenantid" value="{{\Illuminate\Support\Facades\Auth::user()->tenant}}">
                                                            <input type="hidden" name="invited_by" value="{{\Illuminate\Support\Facades\Auth::user()->userid}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="wrap-input100 validate-input" data-validate="Enter Province">
                                                            <input class="input100" type="text" name="province" placeholder="">
                                                            <span class="focus-input100" data-placeholder="Region"></span>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="container-login100-form-btn">
                                                    <button class="login100-form-btn">
                                                        Inviter
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
