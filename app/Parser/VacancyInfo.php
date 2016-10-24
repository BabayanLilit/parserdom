<?php

namespace App\Parser;
use Carbon\Carbon;

/**
 * Class Vacancy
 * @package BabayanLilit\ParserHH
 */
class VacancyInfo
{
    /** @var string */
    public $title;
    /** @var string */
    public $salary;
    /** @var string */
    public $employerName;
    /** @var int */
    public $employerId;
    /** @var string */
    public $responsibility;
    /** @var string */
    public $requirement;
    /** @var string */
    public $city;
    /** @var Carbon */
    public $date;
    /** @var int */
    public $external_id;

    public function toArray()
    {
        return [
            'external_id' => $this->external_id,
            'title' => $this->title,
            'employer_id' => $this->employerId,
            'employer_name' => $this->employerName,
            'city' => $this->city,
            'salary' => $this->salary,
            'date' => $this->date,
            'responsibility' => $this->responsibility,
            'requirement' => $this->requirement,
        ];
    }
}
