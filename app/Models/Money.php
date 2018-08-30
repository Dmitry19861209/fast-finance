<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    protected $table = 'money';

    protected $fillable = [
        'owner_id',
        'value',
        'count',
    ];

    /*
     * Связь с кошельком
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Owners', 'owner_id', 'id');
    }
}
