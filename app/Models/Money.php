<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ModelTrait;

class Money extends Model
{
    const USER_OWNER = 1;
    const VM_OWNER = 2;

    use ModelTrait;

    protected $table = 'money';

    protected $fillable = [
        'owner_id',
        'value',
        'count',
    ];

    /*
     * Связь с владельцем кошелька
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Owners', 'owner_id', 'id');
    }

    public static function updateAllCount($cash, $operation)
    {
        if($operation === 'buy') { //Купить
            $monies = self::where('owner_id', self::VM_OWNER)
                ->orderBy('value', 'DESC')
                ->get();

            return self::cashProcessing($monies, $cash);
        } else { //Сдача
            $monies = self::where('owner_id', self::USER_OWNER)
                ->orderBy('value', 'DESC')
                ->get();

            return self::cashProcessing($monies, $cash);
        }
    }

    /**
     * Разменять деньги
     *
     * @param $monies
     * @param $cash
     * @return mixed
     */
    private static function cashProcessing($monies, $cash)
    {
        foreach ($monies as $key => $money) {
            if ($cash > 0) {
                if ($cash >= $money->value) {
                    $money->updateCount(true);
                    $money->save();
                    $cash = $cash - $money->value;
                    $monies[$key] = $money; //Обновить общий объект

                    return self::cashProcessing($monies, $cash);
                }
            } else
                break;
        }
        return $monies;
    }
}
