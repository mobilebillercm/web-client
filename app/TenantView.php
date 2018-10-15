<?php
namespace App;
use Illuminate\Database\Eloquent\Model;


class TenantView extends Model
{

    protected $table = 'tenantview';
    protected $fillable = ['tenantid', 'name', 'city', 'region', 'description', 'logo', 'enablement', 'users'];


    public function __construct($tenantid = null, $name = null, $city = null, $region = null, $description = null, $logo = null, $enablement = null, $users = null, $attributes = array())
    {
        parent::__construct($attributes);
        $this->tenantid = $tenantid;
        $this->name = $name;
        $this->city = $city;
        $this->region = $region;
        $this->description = $description;
        $this->logo = $logo;
        $this->enablement = $enablement;
        $this->users = $users;

    }


}
