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
    protected $fillable = ['b_id', 'name', 'short_description', 'detailed_description', 'unit_amount', 'currency', 'unit', 'unitquantityintervaldiscountfactors', 'icon'];
    public function __construct($b_id = null, $name = null, $short_description = null, $detailed_description = null,
                                $unit_amount = null, $currency = null, $unit = null,  $unitquantityintervaldiscountfactors = null, $icon = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->b_id = $b_id;
        $this->name = $name;
        $short_d = null;
        if (strlen($short_description) <= 100){
            $short_d = $short_description;
        }else{
            $short_d = substr($short_description, 0, 100);
            $i = 100;
            while (!($short_description[$i]. "" === " ")){
              $short_d .= $short_description[$i++];
            }
        }
        $short_d .= " ...";

        $this->short_description = $short_d;

        $d_d = null;
        if (strlen($this->detailed_description) <= 500){
            $d_d = $detailed_description;
        }else{
            $d_d = substr($detailed_description, 0, 500);
            $i = 500;
            while (!($detailed_description[$i]. "" === " ")){
                $d_d .= $detailed_description[$i++];
            }
        }

        $d_d .= ' ...';

        $this->detailed_description = json_encode(array('Description'=>$d_d, 'performance'=>'Haute Performance',
            'utilisation'=>'Pret a Utiliser', 'Avantage'=>'Augmente vos revenues', 'Assistance'=>'24/24 7jours/7', 'Support'=>'24/24 7jours/7'));
        $this->unit_amount = $unit_amount;
        $this->currency = $currency;
        $this->unit = $unit;
        $this->unitquantityintervaldiscountfactors = $unitquantityintervaldiscountfactors;
        $this->icon = $icon;
    }

}
