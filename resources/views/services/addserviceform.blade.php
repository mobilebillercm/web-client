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
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="">
                                    <div class="" style="color: #3db4e1; border-radius: 8px;">
                                        <div class="" style="width: 100%; padding: 15px; border-radius: 8px;">
                                            <form class="form-style-9" method="post" action="{{url('services/add/new')}}"
                                                  id="form-add-service" enctype="multipart/form-data">

                                                <div class="row">
                                                    <div class="clo-md-12" style="margin: auto; width: 80%; text-align: center; border: 0px red solid;">
                                                       <span class="login100-form-logo">
                                                            <i class="fa fa-plus"></i>
                                                        </span>
                                                        <span class="login100-form-title p-b-34 p-t-27">
                                                            <h4>Creer un nouveau service</h4>
                                                        </span>

                                                        <hr style="margin-top: -20px; width: 75%; margin-left: auto; margin-right: auto; border: 1px #3db4e1 solid;"> <br>

                                                    </div>
                                                </div>


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

                                                <br>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="information-account" id="" style="display: block;" >
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div cclass="form-group" style="text-align: left;">
                                                                        <label for="name" style="font-size: 16px;">Nom <b style="color: red;" class=""> *</b></label>
                                                                        <input type="text" class="form-control form-control-text" required name="name" id="name"
                                                                               placeholder="Nom du Service"
                                                                               style="color: #0d0d0d;" /> <br>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div cclass="form-group" style="text-align: left;">
                                                                        <label for="description" style="font-size: 16px;">Description <b style="color: red;" class=""> *</b></label>
                                                                        <textarea class="form-control form-control-text" required name="description" id="description"
                                                                               placeholder="Decrire le service ici"
                                                                                  style="color: #0d0d0d;" ></textarea> <br>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div cclass="form-group" style="text-align: left;">
                                                                        <label for="icon" style="font-size: 16px;">Icon <b style="color: red;" class=""> *</b></label>
                                                                        <input type="file" class="form-control form-control-text" required name="icon" id="icon"
                                                                               style="color: #0d0d0d;" /> <br>
                                                                        <input type="hidden" name="created_by" value="{{\Illuminate\Support\Facades\Auth::user()->userid}}">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container-login100-form-btn">
                                                    <button class="login100-form-btn-blue" type="submit">
                                                        Creer
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
















