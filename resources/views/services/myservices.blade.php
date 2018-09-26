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

                            input[type=range]::-webkit-slider-thumb {
                                box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
                                border: 0px solid #000000;
                                height: 20px;
                                width: 5px;
                                border-radius: 7px;
                                background: #225274;
                                cursor: pointer;
                                -webkit-appearance: none;
                                margin-top: -3.6px;
                            }



                        </style>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-style-9" style="width: 100%; padding: 15px; border-radius: 8px;">
                                    @if(!($services === null) and count($services) > 0)
                                        <div class="" style="padding-left: 10px; padding-right: 10px;">
                                            <ul class="list-group">
                                                @foreach($services as $service)
                                                    <li class="list-group-item row" >
                                                        <div class="col-md-4">
                                                            <h4>{{$service->name}}</h4>
                                                            <span class="small">{{$service->short_description}}</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <?php $t = time();?>
                                                            @if ($t >= $service->enddate)
                                                                <div class="alert-danger align-content-center" style="text-align: center;">
                                                                    <ul class="">
                                                                        <li class="">
                                                                            <?php
                                                                            $now = date_create(date('Y-m-d H:i:s', $t));
                                                                            $enddate = date_create(date('Y-m-d H:i:s', $service->enddate));
                                                                            $diff=date_diff($enddate,$now);
                                                                            ?>
                                                                            <span class="pull-left">Service non renouvelle il y a </span> <strong class="pull-right">{{$diff->format("%a jours")}}</strong>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @else
                                                                <div class=" " style="">
                                                                    <ul class="">
                                                                        <li class="">
                                                                            <?php
                                                                            $now = date_create(date('Y-m-d H:i:s', $t));
                                                                            $enddate = date_create(date('Y-m-d H:i:s', $service->enddate));
                                                                            $startdate = date_create(date('Y-m-d H:i:s', $service->startdate));
                                                                            $nbJourConsomme =date_diff($startdate,$now);
                                                                            $nbJourRisiduel =date_diff($now, $enddate);
                                                                            $nbJourTotal =date_diff($startdate, $enddate);
                                                                            ?>
                                                                            <span class="pull-left">Service en cour depuis le</span> <strong class="pull-right">{{date('Y-m-d H:i:s', $service->startdate)}}</strong>
                                                                        </li>
                                                                        <li>
                                                                            <span class="pull-left">Nombre de jours consommes</span> <strong class="pull-right">{{$nbJourConsomme->format("%a jours")}}</strong>
                                                                        </li>
                                                                        <li>
                                                                            <span class="pull-left">Nombre de jours restant</span> <strong class="pull-right">{{$nbJourRisiduel->format("%a jours")}}</strong>
                                                                        </li>
                                                                        <li>
                                                                            <span class="pull-left">Nombre de jours Total</span> <strong class="pull-right">{{$nbJourTotal->format("%a jours")}}</strong>
                                                                        </li>

                                                                        {{--<li>
                                                                            <span class="pull-left"></span><strong class="pull-right" style="color: red; font-size: large;">Expire le: {{date('Y-m-d H:i:s', $service->enddate)}}</strong>
                                                                        </li>


                                                                        <li >

                                                                            <input type="range" name="quantity" max="{{$nbJourTotal->format("%a")}}" min="0"
                                                                                   value="{{$nbJourConsomme->format("%a")}}"
                                                                                   step="1" style="color: #3db4e1;  padding-top: 20px;" disabled />
                                                                        </li>--}}
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-4">
                                                            <?php $t = time();?>
                                                            @if ($t >= $service->enddate)
                                                                <div class="alert-danger align-content-center" style="text-align: center;">
                                                                    <ul class="">
                                                                        <li class="">
                                                                            <?php
                                                                            $now = date_create(date('Y-m-d H:i:s', $t));
                                                                            $enddate = date_create(date('Y-m-d H:i:s', $service->enddate));
                                                                            $diff=date_diff($enddate,$now);
                                                                            ?>
                                                                            <span class="pull-left">Service non renouvelle il y a </span> <strong class="pull-right">{{$diff->format("%a jours")}}</strong>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @else
                                                                <div class=" " style="">
                                                                    <ul class="">

                                                                        <?php
                                                                        $now = date_create(date('Y-m-d H:i:s', $t));
                                                                        $enddate = date_create(date('Y-m-d H:i:s', $service->enddate));
                                                                        $startdate = date_create(date('Y-m-d H:i:s', $service->startdate));
                                                                        $nbJourConsomme =date_diff($startdate,$now);
                                                                        $nbJourRisiduel =date_diff($now, $enddate);
                                                                        $nbJourTotal =date_diff($startdate, $enddate);
                                                                        ?>
                                                                        {{--<li class="">
                                                                            <span class="pull-left">Service en cour depuis le</span> <strong class="pull-right">{{date('Y-m-d H:i:s', $service->startdate)}}</strong>
                                                                        </li>
                                                                        <li>
                                                                            <span class="pull-left">Nombre de jours consommes</span> <strong class="pull-right">{{$nbJourConsomme->format("%m mois %d jours")}}</strong>
                                                                        </li>
                                                                        <li>
                                                                            <span class="pull-left">Nombre de jours restant</span> <strong class="pull-right">{{$nbJourRisiduel->format("%m mois %d jours")}}</strong>
                                                                        </li>
                                                                        <li>
                                                                            <span class="pull-left">Nombre de jours Total</span> <strong class="pull-right">{{$nbJourTotal->format("%y annee %m mois %d jours")}}</strong>
                                                                        </li>--}}

                                                                        <li>
                                                                            <span class="pull-left"></span><strong class="pull-right" style="color: red; font-size: large;">Expire le: {{date('Y-m-d H:i:s', $service->enddate)}}</strong>
                                                                        </li>


                                                                        <li >

                                                                            <input type="range" name="quantity" max="{{$nbJourTotal->format("%a")}}" min="0"
                                                                                   value="{{$nbJourConsomme->format("%a")}}"
                                                                                   step="1" style="color: #3db4e1;  padding-top: 20px;" disabled />
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    @else
                                        <div class="alert-danger align-content-center" style="text-align: center;">Aucun Service trouve</div>
                                    @endif
                                    {{--json_encode($services)--}}
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
