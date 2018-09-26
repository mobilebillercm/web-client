<?php
/**
 * Created by PhpStorm.
 * User: el
 * Date: 9/21/18
 * Time: 2:36 PM
 */

namespace App\domain\model;


use Illuminate\Database\Eloquent\Model;

class ClientServiceValidity extends Model
{

    protected $table = 'client_service_validities';

    protected $fillable = ['serviceid', 'clientid', 'tenantid', 'startdate', 'enddate', 'enablementstatus', 'reasonenablementchanged',
        'name', 'short_description', 'long_description'];


    public function __construct($serviceid = null, $clientid = null, $tenantid = null, $startdate = null, $enddate = null, $enablementstatus = null,
                                $name = null, $short_description = null, $long_description = null, $attributes = array())
    {
        parent::__construct($attributes);
        $this->serviceid = $serviceid;
        $this->clientid = $clientid;
        $this->tenantid = $tenantid;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->enablementstatus = $enablementstatus;
        $this->name = $name;
        $this->short_description = $short_description;
        $this->long_description = $long_description;
    }
}
