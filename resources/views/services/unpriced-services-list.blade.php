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
                                        <br><br><br>
                                        <div class="row">

                                            <div class="col-md-12">
                                                @if($unpricedservices and count($unpricedservices) > 0)

                                                    <div class="panel panel-primary filterable">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Parametrage de Prix de services</h3>
                                                            <div class="pull-right">
                                                                <button class="btn btn-default btn-xs btn-filter"
                                                                        style="height: 25px; border-radius: 5px; margin-top: -8px; text-align: center;">
                                                                    <span class="glyphicon glyphicon-filter" style="margin-top: -7px;"></span> Filter</button>
                                                            </div>
                                                        </div>

                                                        <table class="table">
                                                            <thead>
                                                            <tr class="filters" style="height: 35px;">
                                                                <th><input type="text" class="form-control form-control-text" placeholder="#" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                <th><input type="text" class="form-control form-control-text" placeholder="Nom" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                <th><input type="text" class="form-control form-control-text" placeholder="Description" disabled style="height: 30px; border-radius: 5px;"></th>
                                                                <th><input type="text" class="form-control form-control-text" placeholder="Action" disabled style="height: 30px; border-radius: 5px;"></th>
                                                            </tr>
                                                            </thead>

                                                            <?php $num = 1; ?>

                                                            @foreach($unpricedservices as $unpricedservice)
                                                                <tr style="color: #225274;">
                                                                    <td>{{$num}}</td>
                                                                    <td>{{$unpricedservice->name}}</td>
                                                                    <td>{{$unpricedservice->description}}</td>

                                                                    <td style="text-align: center;">

                                                                        <a href="{{url('services/' . $unpricedservice->service_id.'/price')}}" >
                                                                            <img src="{{asset('/assets/images/money.jpg')}}" height="40" width="55">

                                                                        </a>
                                                                    </td>
                                                                    <?php $num ++; ?>
                                                                </tr>
                                                            @endforeach
                                                        </table>

                                                    </div>
                                                @else
                                                    <div class="alert-danger" style="padding: 15px; text-align: center; font-size: large; color: red; font-weight: bold;">
                                                        <h4 style="font-size: large; color: red; font-weight: bold;">Pas de service</h4>
                                                    </div>
                                                @endif
                                            </div>

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
















