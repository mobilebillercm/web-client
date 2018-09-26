<?php
/**
 * Created by PhpStorm.
 * User: nkalla
 * Date: 24/09/18
 * Time: 09:44
 */
namespace App\domain\model;
use \Illuminate\Database\Eloquent\Model;
class Service extends Model
{
    protected $table = 'services';
    protected $fillable = ['b_id', 'name', 'short_description', 'detailed_description', 'unit_amount', 'currency', 'unit', 'icon'];
    public function __construct($b_id = null, $name = null, $short_description = null, $detailed_description = null,
                                $unit_amount = null, $currency = null, $unit = null, $icon = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->b_id = $b_id;
        $this->name = $name;
        $this->short_description = $short_description;
        $this->detailed_description = $detailed_description;
        $this->unit_amount = $unit_amount;
        $this->currency = $currency;
        $this->unit = $unit;
        $this->icon = $icon;
    }

}
