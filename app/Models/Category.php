<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function getValue(?string $type)
    {
        $result = 1;
        switch ($type){
            case "9":   //run
                $result = 1;
                break;
            case "1":   //ride
                $result = 3;
                break;
            case "10":  //walk
                $result = 2;
            case "7":   //ski
                $result = 4;
                break;
            default:
                $result = 5;
        }
        return $result;
    }
}
