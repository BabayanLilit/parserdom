<?php

namespace App\Http\Controllers;

use App\Vacancy;
use Artisan;
use Illuminate\Http\Request;

/**
 * Class VacancyController
 * @package App\Http\Controllers
 */
class VacancyController extends Controller
{
    public function parseTodayVacancies()
    {
        Artisan::call('parse:vacancies', [
            '--pages-per-city' => 1
        ]);

        return redirect()->route('vacancy.index');
    }

    public function index($city = '')
    {
        $vacancies = Vacancy::where('city', 'like', '%' . $city . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        return view('vacancies.index', [
            'vacancies' => $vacancies,
            'city' =>$city
        ]);
    }
}
