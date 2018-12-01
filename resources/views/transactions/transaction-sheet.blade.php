@extends('layouts.app')
@section('title', 'MOBILEBILEER/SIGNUP')
@section('commonsection')
    <div class="overlay"></div>
    {{--<div class="container">--}}
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="main_home">
                <div class="home_text">

                    <div class="main_home">
                        <br><br><br>




                                @if($transaction['success'] === 1 and $transaction['faillure'] === 0)
                                    <div class="row">

                                        <div class="panel panel-primary">
                                            <div class="panel-heading" style="color: #FFFFFF; text-align: center;">
                                                <h3 style="color: #FFFFFF; text-align: center;">Fiche de Transaction </h3>
                                                <h4 style="color: #FFFFFF; text-align: center;">ID: {{$transaction['response']['made_by']['b_id']}}</h4>
                                            </div>
                                            <div class="panel-body">

                                                <div class="row">
                                                    <div class="col-md-8">

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <br>
                                                                <h4>Source</h4>
                                                                <hr class="ligne">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="panel panel-info">
                                                                    <div class="panel-heading">
                                                                        <h5>Details du Compte</h5>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item list-group-item-primary"><h6><b>Utilisateur du compte</b></h6></li>
                                                                            <li class="list-group-item">
                                                                                <h6>Identifiant: {{$transaction['response']['made_by']['b_id']}}</h6>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <h6>Nom: {{$transaction['response']['made_by']['firstname']}}<br>
                                                                                    Prenom: {{$transaction['response']['made_by']['lastname']}}</h6>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <h6>Telephone: {{$transaction['response']['made_by']['phone']}}</h6>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <h6>Telephone: {{$transaction['response']['made_by']['phone']}}</h6>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="panel panel-info">
                                                                    <div class="panel-heading">
                                                                        <h5>Compte utilise</h5>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item list-group-item-dark"><h6><b>Details</b></h6></li>
                                                                            <li class="list-group-item">
                                                                                <h6>Identifiant: {{$transaction['response']['mobilebillercreditaccount']['b_id']}}</h6>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <h6>Fournisseur: {{$transaction['response']['mobilebillercreditaccount']['issuer']}}</h6>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <h6>Etat: {{$transaction['response']['mobilebillercreditaccount']['active'] == 1 ? 'Actif':'Deactive'}}</h6>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <br>
                                                                <h4>Beneficiaire</h4>
                                                                <hr class="ligne">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="panel panel-info">
                                                                    <div class="panel-heading">
                                                                        <h5>Details du Beneficiaire</h5>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item list-group-item-primary"><h6><b>Utilisateur du compte</b></h6></li>
                                                                            @if(!($transaction['response']['beneficiary_account'] === null))
                                                                                <li class="list-group-item">
                                                                                    <h6>Identifiant: {{$transaction['response']['beneficiary']['b_id']}}</h6>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <h6>Nom: {{$transaction['response']['beneficiary']['firstname']}}<br>
                                                                                        Prenom: {{$transaction['response']['beneficiary']['lastname']}}</h6>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <h6>Telephone: {{$transaction['response']['beneficiary']['phone']}}</h6>
                                                                                </li>
                                                                            @else

                                                                            @endif


                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="panel panel-info">
                                                                    <div class="panel-heading">
                                                                        <h5>Compte utilise</h5>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item list-group-item-dark"><h6><b>Details</b></h6></li>
                                                                            @if(!($transaction['response']['beneficiary_account'] === null))
                                                                                <li class="list-group-item">
                                                                                    <h6>Identifiant: {{$transaction['response']['beneficiary_account']['b_id']}}</h6>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <h6>Fournisseur: {{$transaction['response']['beneficiary_account']['issuer']}}</h6>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <h6>Etat: {{$transaction['response']['beneficiary_account']['active'] == 1 ? 'Actif':'Deactive'}}</h6>
                                                                                </li>
                                                                            @else

                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <br>
                                                                <h4>Details de la Transaction</h4>
                                                                <hr class="ligne">
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="panel panel-info">
                                                                    <div class="panel-heading">
                                                                        <h5>Donnees de la Transaction</h5>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <ul class="list-group">
                                                                                    <li class="list-group-item list-group-item-dark"><h6><b>Details</b></h6></li>

                                                                                    <li class="list-group-item">
                                                                                        <h6>Identifiant de la transaction: {{$transaction['response']['b_id']}}</h6>
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                        <h6>Date: {{$transaction['response']['date']}}</h6>
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                        <h4><b>Montant: {{$transaction['response']['amount']}}</b></h4>
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                        <h4><b>Etat: {{$transaction['response']['state']}}</b></h4>
                                                                                    </li>

                                                                                    <li class="list-group-item">
                                                                                        <h6>Identifiant Client de la Transaction: {{$transaction['response']['user_transaction_number']}}</h6>
                                                                                    </li>

                                                                                    <li class="list-group-item">
                                                                                        <h6>Resultat de la Transaction: {{$transaction['response']['returned_result']}}</h6>
                                                                                    </li>

                                                                                </ul>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                @if(!($transaction['response']['transaction_details'] == null))
                                                                                    <ul class="list-group">
                                                                                        <li class="list-group-item list-group-item-dark">
                                                                                            <h6><b>Details sur le compte Debite</b></h6>
                                                                                            <h6>Numero de Compte utilise: {{$transaction['response']['transaction_details']['account_number']}}</h6>
                                                                                            <h6>Titulaire: {{$transaction['response']['transaction_details']['account_holder']}}</h6>
                                                                                            <h6>Code de securite: {{$transaction['response']['transaction_details']['account_security_code']}}</h6>
                                                                                        </li>


                                                                                        @if(!($transaction['response']['transaction_details']['transactionType'] == null))

                                                                                            <li class="list-group-item">
                                                                                                <h6><b>Detail du Type de Transaction</b></h6>
                                                                                                <h6>Type : {{$transaction['response']['transaction_type']['name']}}</h6>
                                                                                                <h6>Description: {{$transaction['response']['transaction_type']['description']}}</h6>
                                                                                                <h6>Signe: {{$transaction['response']['transaction_type']['signe']}}</h6>
                                                                                            </li>
                                                                                        @endif

                                                                                    </ul>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                            <div class="row">



                            </div>
                                @else
                                    <div class="alert-danger" style="padding: 15px; text-align: center; font-size: large; color: red; font-weight: bold;">
                                        <h4 style="font-size: large; color: red; font-weight: bold;">{{$transaction['raison']}}</h4>
                                    </div>
                                @endif



                        <div id="dropDownSelect1"></div>
                    </div>

                </div>

                <div class="home_btns m-top-40">

                </div>


            </div>
        </div>

    </div><!--End off row-->
    {{--</div>--}}<!--End off container -->
@endsection
