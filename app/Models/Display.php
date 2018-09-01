<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    protected $table = 'display';

    protected $fillable = [
        'pay_sum',
    ];

    /**
     * Update pay sum
     *
     * @param $value
     * @param bool $plus
     * @return mixed
     */
    public static function updatePaySum($value, $plus=false)
    {
        $_this = self::first();
        $paySum = $_this->pay_sum;

        if($plus) {
            $_this->pay_sum = $paySum + $value;
            $_this->save();

            return $_this;
        } else {
            if($paySum >= $value) {
                $_this->pay_sum = $paySum - $value;
                $_this->save();

                return $_this;
            }

            return false;
        }
    }

    public static function defaultPaySum()
    {
        $display = self::first();
        $display->pay_sum = 0;
        $display->save();

        return $display;
    }
}
