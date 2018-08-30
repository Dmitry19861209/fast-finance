<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
    protected $table = 'owners';

    protected $fillable = [
        'name'
    ];

    /*
     * Связь с кошельком
     */
    public function money()
    {
        return $this->hasMany('App\Models\Money', 'owner_id', 'id');
    }
}
