@extends('layouts.app')
@section('title', 'MOBILEBILEER/LOGIN')
@section('commonsection')
    <div class="overlay"></div>

    <div class="container">

        <div class="row">
                <div class="main_home">
                    <div class="home_text">
                        <div class="main_home">
                            <br />
                            <h1 class="text-white">MOBILE BILLER - CREATIVE DESIGNERS!</h1>

                            <div class="limiter">
                                <h2 class="our-services ">Nos Services</h2>
                                <div class="row" style="margin-top: -20px;">
                                    @if($services and count($services) > 0)
                                        @foreach($services as $service)

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="home-products-col animation clickable-area flip-container" ontouchstart="this.classList.toggle('hover');">
                                                    <div class="flipper">
                                                        <div class="home-product-col-blue front">
                                                            <div class="">
                                                                <h3 class="home-products-col-details-title"
                                                                    style="color: #fff; text-size: 25px;font-weight:900; margin-top: 30px; margin-bottom: -20px;">
                                                                    {{$service->name}}
                                                                </h3>
                                                                <p class="subtitle">{{$service->short_description}}</p>
                                                            </div>
                                                            <div class="home-product-col-price-box">
                                                                <img alt="Best Price" class="home-best-price-vps" src="{{asset('assets/images/best-price-home.png')}}" />
                                                                <p class="apartireda">A partir de</p>
                                                                <p class="home-prodotto-prezzo" style="font-size: 35px;">{{$service->unit_amount}}<sup>{{$service->currency}}</sup>
                                                                    <sub>/{{$service->unit}}</sub></p>

                                                            </div>
                                                            <div>
                                                                <img src="{{url('services/'.$service->b_id.'/icon')}}" style="border-radius: 50%; margin-top: 30px;" height="150" width="150"></div>
                                                        </div>
                                                        <div class="home-products-col-details-box back">
                                                            <div style="background: #FFFFFF;">
                                                                <div style="width: 100%; height: 100%; background: rgba(255,255,255,0.9); border: #ff321b 0px solid;">
                                                                    <?php
                                                                    $details = json_decode($service->detailed_description, true);
                                                                    //$keys = array_keys($details);
                                                                    ?>
                                                                    <h3 class="home-products-col-details-title">{{$details['performance']}}<br />{{$details['utilisation']}}</h3>
                                                                    <ul class="home-products-col-details-list">

                                                                        @foreach($details as $key => $value)
                                                                            @if(!($key == 'performance') and !($key == 'utilisation') )
                                                                                <li>{{$key}}<strong>{{$value}}</strong></li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="home-products-col animation clickable-area">
                                                    <div class="home-product-col-white">
                                                        <h4>Definir Mon Packet</h4>
                                                        <form action="{{url('services/pay-step1')}}" class="" method="get">
                                                            @csrf
                                                            <div class="form-group" style="text-align: left; margin-left: 10px; margin-right: 10px;">
                                                                <label for="{{$service->b_id}}" style="color: #3db4e1;"><span id="n_unit_{{$service->b_id}}">1</span>
                                                                    <span id="unit_{{$service->b_id}}">{{$service->unit}}</span> <span id="decimal_unit_{{$service->b_id}}"></span></label>
                                                                <input type="range" name="quantity" max="12" min="0.5" value="1" step="0.5" id="{{$service->b_id}}"
                                                                       style="color: #3db4e1;" onchange="getPrice('{{$service->b_id}}', this.value);">
                                                                <label for="{{$service->b_id}}" class="pull-right" style="color: #3db4e1;">
                                                                    <span id="total_amount_{{$service->b_id}}">{{$service->unit_amount}}</span>{{$service->currency}}</label>
                                                                <small id="emailHelp" class="form-text text-muted" style="color: #3db4e1;">{{--We'll never share your email with anyone else.--}}</small>
                                                                <input name="servicename" value="{{$service->name}}" type="hidden" id="service_{{$service->b_id}}">
                                                                <input name="serviceshortdescription" value="{{$service->short_description}}" type="hidden">
                                                                <input name="serviceid" value="{{$service->b_id}}" type="hidden">
                                                                <input name="price" value="{{$service->unit_amount}}" type="hidden" id="price_{{$service->b_id}}">
                                                                <input name="unit" value="{{$service->unit}}" type="hidden" id="unit_{{$service->b_id}}">
                                                                <input name="currency" value="{{$service->currency}}" type="hidden" id="currency_{{$service->b_id}}">
                                                            </div>

                                                            <div class="form-group" style="text-align: left; margin-left: 10px; margin-right: 10px;">
                                                                <button type="submit" class="login100-form-btn center">Definir</button>
                                                            </div>
                                                            <div class="form-group" style="text-align: left; margin-left: 10px; margin-right: 10px;">

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>


                                            </div>

                                        @endforeach
                                    @else
                                        <div class="alert-danger">No Service found</div>
                                    @endif
                                </div>

                            </div>
                        </div>




                    </div>




                </div>

        </div><!--End off row-->
    </div><!--  End off container -->
@endsection
