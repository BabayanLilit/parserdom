<?php

namespace App\Http\Controllers;

use Artisan;

/**
 * Class VacancyController
 * @package App\Http\Controllers
 */
class VacancyController extends Controller
{
    public function parseTodayVacancies()
    {
        Artisan::call('parse:vacancies --pages-per-city=1');
    }
}
