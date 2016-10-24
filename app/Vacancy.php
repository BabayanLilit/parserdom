<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Vacancy
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $external_id
 * @property string $name
 * @property string $pay
 * @property string $description
 * @property string $company
 * @property integer $city_id
 * @property string $date
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereExternalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy wherePay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereCityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vacancy whereDate($value)
 * @mixin \Eloquent
 */
class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'external_id',
        'salary',
        'city',
        'date',
        'employer_id',
        'employer_name',
        'responsibility',
        'requirement'
    ];
}
