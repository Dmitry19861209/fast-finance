<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ModelTrait;

class Products extends Model
{
    use ModelTrait;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'count',
    ];
}
