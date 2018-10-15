@extends('layouts.app')
@section('title', 'MOBILEBILEER/SIGNUP')
@section('commonsection')
    <div class="overlay"></div>
    {{--<div class="container">--}}
        <div class="row">
            <div class="main_home">
                <div class="home_text">

                    <div class="main_home">
                        <br><br><br>

                        <div class="row">

                            <div class="col-md-1"></div>

                            <div class="col-md-10">
                                @if(!($tickets === null) and $tickets['success'] === 1 and $tickets['faillure'] === 0 and count($tickets['response']) > 0)

                                    <div class="row">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" style="color: #FFFFFF; text-align: center;">
                                                <h3 style="color: #FFFFFF; text-align: center;"><b>Mes Tickets</b></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        @foreach($tickets['response'] as $ticket)
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <div class="home-products-col animation clickable-area">
                                                    <div class="home-product-col-white" style="text-align: left;">
                                                        <div class="panel panel-info">
                                                            <div class="panel-heading">
                                                                <h5><b>ID: {{$ticket->b_id}}</b></h5>
                                                            </div>
                                                            <div class="panel-body">
                                                                @if(!($ticket->transaction_id === null) and !($ticket->transaction_id === ''))
                                                                    <li >
                                                                        <h6>ID Transaction: {{$ticket->transaction_id}}</h6>
                                                                    </li>
                                                                @endif

                                                                    @if(!($ticket->transaction_state === null) and !($ticket->transaction_state === ''))
                                                                        <li >
                                                                            <h6>Etat Transaction: {{$ticket->transaction_state}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->transaction_amount === null) and !($ticket->transaction_amount === ''))
                                                                        <li >
                                                                            <h6>Montant Transaction: <b>{{$ticket->transaction_amount}} {{$ticket->transaction_currency}}</b></h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->transaction_beneficiary_name === null) and !($ticket->transaction_beneficiary_name === ''))
                                                                        <li >
                                                                            <h6>Beneficiaire Transaction: {{$ticket->transaction_beneficiary_name}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->transaction_beneficiary_account_number === null) and !($ticket->transaction_beneficiary_account_number === ''))
                                                                        <li >
                                                                            <h6>Compte Beneficiaire: {{$ticket->transaction_beneficiary_account_number}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->transaction_date === null) and !($ticket->transaction_date === ''))
                                                                        <li >
                                                                            <h6>Date Transaction: {{$ticket->transaction_date}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->transaction_type === null) and !($ticket->transaction_type === ''))
                                                                        <li >
                                                                            <h6>Type Transaction: {{$ticket->transaction_type}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->transaction_reference === null) and !($ticket->transaction_reference === ''))
                                                                        <li >
                                                                            <h6>Reference Transaction: {{$ticket->transaction_reference}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->transaction_fees === null) and !($ticket->transaction_fees === ''))
                                                                        <li >
                                                                            <h6>Frais Transaction: {{$ticket->transaction_fees}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->transaction_balance === null) and !($ticket->transaction_balance === ''))
                                                                        <li >
                                                                            <h6>Solde Apres Transaction: {{$ticket->transaction_balance}} {{$ticket->transaction_currency}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->sms_sender === null) and !($ticket->sms_sender === ''))
                                                                        <li >
                                                                            <h6>Expediteur: {{$ticket->sms_sender}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->sms_date === null) and !($ticket->sms_date === ''))
                                                                        <li >
                                                                            <h6>Date Reception SMS: {{$ticket->sms_date}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->sms_body === null) and !($ticket->sms_body === ''))
                                                                        <li >
                                                                            <h6>Corps du SMS: {{$ticket->sms_body}}</h6>
                                                                        </li>
                                                                    @endif

                                                                    @if(!($ticket->sms_receiver === null) and !($ticket->sms_receiver === ''))
                                                                        <li >
                                                                            <h6>Recepteur SMS: {{$ticket->sms_receiver}}</h6>
                                                                        </li>
                                                                    @endif


                                                            </div>
                                                            <div class="panel-footer">
                                                                <li >
                                                                    <h6>Enregistre le: <b>{{$ticket->created_at}}</b></h6>
                                                                </li>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                            <div class="col-md-12">
                                                <ul class="" style="">
                                                    <li class="" style="text-align: center; padding-bottom: -25px;">{{ $tickets['response']->links() }}</li>
                                                </ul>
                                            </div>
                                    </div>
                                @else
                                    <div class="alert-danger" style="padding: 15px; text-align: center; font-size: large; color: red; font-weight: bold;">
                                        <h4 style="font-size: large; color: red; font-weight: bold;">Vous n'avez pas de Ticket Imprime</h4>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-1"></div>

                        </div>
                        <div id="dropDownSelect1"></div>
                    </div>

                </div>

                <div class="home_btns m-top-40">

                </div>


            </div>
        </div><!--End off row-->
    {{--</div>--}}<!--End off container -->
@endsection
