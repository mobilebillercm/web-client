<?php
/**
 * Created by PhpStorm.
 * User: nkalla
 * Date: 29/09/18
 * Time: 11:42
 */

namespace App\domain\model;


use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['b_id', 'transaction_type', 'transaction_state', 'transaction_amount', 'transaction_beneficiary_name',
        'transaction_beneficiary_account_number', 'transaction_date', 'transaction_id', 'transaction_reference', 'transaction_fees',
        'transaction_balance', 'transaction_currency', 'sms_sender', 'sms_date', 'sms_body', 'sms_receiver', 'belongs_to', 'tenant'];

    public function __construct($b_id = null, $transaction_type = null, $transaction_state = null,  $transaction_amount = null,
                                $transaction_beneficiary_name = null, $transaction_beneficiary_account_number = null,
                                $transaction_date = null, $transaction_id = null, $transaction_reference = null, $transaction_fees = null,
                                $transaction_balance = null, $transaction_currency = null, $sms_sender = null, $sms_date = null,
                                $sms_body = null, $sms_receiver = null, $belongs_to = null, $tenant = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->b_id = $b_id;
        $this->transaction_type = $transaction_type;
        $this->transaction_state = $transaction_state;
        $this->transaction_amount = $transaction_amount;
        $this->transaction_beneficiary_name = $transaction_beneficiary_name;
        $this->transaction_beneficiary_account_number = $transaction_beneficiary_account_number;
        $this->transaction_date = $transaction_date;
        $this->transaction_id = $transaction_id;
        $this->transaction_reference = $transaction_reference;
        $this->transaction_fees = $transaction_fees;
        $this->transaction_balance = $transaction_balance;
        $this->transaction_currency = $transaction_currency;
        $this->sms_sender = $sms_sender;
        $this->sms_date = $sms_date;
        $this->sms_body = $sms_body;
        $this->sms_receiver = $sms_receiver;
        $this->belongs_to = $belongs_to;
        $this->tenant = $tenant;
    }

}
