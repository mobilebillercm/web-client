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

                            <div class="row">

                                <div class="col-md-12">
                                    @if($transactions and !(is_string($transactions)))
                                        <div class="panel panel-primary filterable">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Mes Transactions</h3>
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
                                                    <th><input type="text" class="form-control form-control-text" placeholder="Date" disabled style="height: 30px; border-radius: 5px;"></th>
                                                    <th><input type="text" class="form-control form-control-text" placeholder="Effectue par" disabled style="height: 30px; border-radius: 5px;"></th>
                                                    <th><input type="text" class="form-control form-control-text" placeholder="Type de Transaction" disabled style="height: 30px; border-radius: 5px;"></th>
                                                    <th><input type="text" class="form-control form-control-text" placeholder="Montant" disabled style="height: 30px; border-radius: 5px;"></th>
                                                    <th><input type="text" class="form-control form-control-text" placeholder="Etat" disabled style="height: 30px; border-radius: 5px;"></th>
                                                    <th><input type="text" class="form-control form-control-text" placeholder="Solde Avant" disabled style="height: 30px; border-radius: 5px;"></th>
                                                    <th><input type="text" class="form-control form-control-text" placeholder="Plus de Detail" disabled style="height: 30px; border-radius: 5px;"></th>
                                                </tr>
                                                </thead>

                                                <?php $num = 1; ?>

                                                @foreach($transactions as $transaction)
                                                    <tr style="color: #225274;">
                                                        <td>{{$num}}</td>
                                                        <td>{{$transaction->date}}</td>
                                                        <td>{{$transaction->made_by}}</td>
                                                        <?php
                                                        $transactionTypeDetails = \App\domain\model\TransactionType::where('b_id', '=', $transaction->transaction_type)->get();
                                                        $alertcolor = ($transaction->state == 'PENDING')?'alert-warning':($transaction->state == 'FAILED')?'alert-danger':'alert-success';
                                                        $account = json_decode($transaction->accountstate);
                                                        $beforeAmount = '';
                                                        if (!($account === null)){
                                                            $beforeAmount = $account->balance;
                                                        }
                                                        /*
                                                         * ['b_id', 'date', 'mobilebillercreditaccount', 'made_by', 'amount', 'transaction_type',
        'transaction_details', 'user_transaction_number', 'state', 'returned_result', 'accountstate']
                                                            const PENDING = "PENDING";
    const FAILED = "FAILED";
    const SUCCESS = "SUCCESS";
    protected
                                                         */
                                                        ?>
                                                        <td>{{$transactionTypeDetails[0]->name}}</td>
                                                        <td>{{$transaction->amount}}</td>
                                                        <td class="alert {{$alertcolor}}">{{$transaction->state}}</td>
                                                        <td>{{$beforeAmount}}</td>
                                                        <td style="text-align: center;">

                                                            <a href="{{url('wallets/transactions/details/' . $transaction->b_id)}}" >
                                                                <i class="fa fa-angle-right" style="font-size: 35px; color: #225274;"></i></a>
                                                        </td>
                                                        <?php $num ++; ?>
                                                    </tr>
                                                @endforeach
                                                <tfoot>
                                                <tr>
                                                    <th colspan="8">
                                                        <ul class="" style="">
                                                            <li class="" style="text-align: center; padding-bottom: -25px;">{{ $transactions->links() }}</li>
                                                        </ul>
                                                    </th>
                                                </tr>

                                                </tfoot>

                                            </table>

                                        </div>
                                    @else
                                        <div class="alert-danger" style="padding: 15px; text-align: center; font-size: large; color: red; font-weight: bold;">
                                            <h4 style="font-size: large; color: red; font-weight: bold;">{{$transactions}}</h4>
                                        </div>
                                    @endif
                                </div>

                            </div>
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
