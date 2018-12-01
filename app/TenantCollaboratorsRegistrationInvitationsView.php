<?php
/**
 * Created by PhpStorm.
 * User: el
 * Date: 10/9/18
 * Time: 9:33 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TenantCollaboratorsRegistrationInvitationsView extends  Model
{
    protected $table = 'tenantcollaboratorsregistrationinvitationsview';
    protected $fillable = ['userid', 'tenantid', 'firstname', 'lastname', 'email', 'phone', 'invited_by', 'invited_at', 'url', 'active'];


    public function __construct($userid = null, $tenantid = null, $firstname = null, $lastname = null,$email = null,$phone = null,
                                $invited_by = null, $invited_at = null, $url = null, $active = null, $attributes = array())
    {

        parent::__construct($attributes);
        $this->userid = $userid;
        $this->tenantid = $tenantid;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->invited_by = $invited_by;
        $this->invited_at = $invited_at;
        $this->url = $url;
        $this->active = $active;
    }
}