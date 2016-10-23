<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'name',
        'extern_id',
        'pay',
        'city_id',
        'city_name',
        'date',
        'company',
        'description'
    ];
}
