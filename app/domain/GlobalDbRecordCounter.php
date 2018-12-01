<?php
/**
 * Created by PhpStorm.
 * User: el
 * Date: 9/20/18
 * Time: 11:03 AM
 */

namespace App\domain;


class GlobalDbRecordCounter
{


    public static function  countDbRecordIsExactlelZero($records){

        if((count($records) === 0)){
            return true;
        }else{
            return false;
        }
    }

    public static function  countDbRecordIsExactlelOne($records){

        if((count($records) === 1)){
            return true;
        }else{
            return false;
        }
    }

    public static function  countDbRecordIsMultipleOrOne($records){

        if((count($records) >= 1)){
            return true;
        }else{
            return false;
        }
    }


}