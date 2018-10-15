<?php

namespace App\domain\model;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $table = 'units';
    protected $fillable = ['name'];


    public function __construct($name =null, $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
    }

}
