<?php

namespace App\Parser;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Parser
 * @package BabayanLilit\ParserHH
 */
class Parser
{
    const PERIOD_DAY = '1';
    const PERIOD_THREE_DAYS = '3';
    const PERIOD_WEEK = '7';
    const PERIOD_MONTH = '';
    const RUSSIA_CITY_ID = 113;
    const MOSCOW_CITY_ID = 1;
    const SPB_CITY_ID = 2;

    /** @var string */
    private $period = self::PERIOD_DAY;
    /** @var int */
    private $pagesPerCity = 10;
    /** @var string */
    private $urlPattern = "https://hh.ru/search/vacancy?area=%s&search_period=%s&page=%s&order_by=publication_time&items_on_page=500";

    public $cityIds = [
        self::RUSSIA_CITY_ID,
        self::SPB_CITY_ID,
        self::MOSCOW_CITY_ID
    ];

    private static $months = [
        'января' => 1,
        'февраля' => 2,
        'марта' => 3,
        'апреля' => 4,
        'мая' => 5,
        'июня' => 6,
        'июля' => 7,
        'августа' => 8,
        'сентября' => 9,
        'октября' => 10,
        'ноября' => 11,
        'декабря' => 12,
    ];

    /**
     * @param callable $callback
     */
    public function parse($callback)
    {
        $client = new Client();

        foreach ($this->cityIds as $cityId) {
            for ($page = 0; $page < $this->pagesPerCity; $page++) {
                $url = $this->buildUrl($page, $cityId);

                try {
                    $response = $client->get($url);
                    $html = (string) $response->getBody();
                    $this->parsePageDom($html, $callback);

                } catch (ClientException $e) {
                    if ($e->getCode() == 404) {
                        // Закончились страницы, переходим к следующему городу
                        continue 2;
                    }

                    throw $e;
                }
            }
        }

    }

    /**
     * @param string $html
     * @param callable $callback
     */
    protected function parsePageDom($html, $callback) {
        $dom = new Crawler($html);
        $dom->filterXPath("//div[@class='search-result']/div")
            ->each(function (Crawler $dom) use ($callback) {
            $vacancy = new VacancyInfo();

            $titleDom = $dom->filterXPath("//a[contains(@data-qa, 'vacancy-serp__vacancy-title')]");
            if ($titleDom->count()) {
                $link = $titleDom->attr('href');
                $linkParts = explode("/", $link);

                $vacancy->external_id = (int) array_pop($linkParts);
                $vacancy->title = trim($titleDom->text());
            }

            $salaryDom = $dom->filterXPath("//div[contains(@data-qa, 'vacancy-serp__vacancy-compensation')]");
            if ($salaryDom->count()) {
                $vacancy->salary = trim($salaryDom->text());
            }

            $employerDom = $dom->filterXPath("//a[contains(@data-qa, 'vacancy-serp__vacancy-employer')]");
            if ($employerDom->count()) {
                $link = $employerDom->attr('href');
                $linkParts = explode("/", $link);

                $vacancy->employerId = (int) array_pop($linkParts);
                $vacancy->employerName = trim($employerDom->text());
            }

            $responsibilityDom = $dom->filterXPath(
                "//div[contains(@data-qa, 'vacancy-serp__vacancy_snippet_responsibility')]");
            if ($responsibilityDom->count()) {
                $vacancy->responsibility = trim($responsibilityDom->text());
            }

            $requirementDom = $dom->filterXPath(
                "//div[contains(@data-qa, 'vacancy-serp__vacancy_snippet_requirement')]");
            if ($requirementDom->count()) {
                $vacancy->requirement = trim($requirementDom->text());
            }

            $cityDom = $dom->filterXPath(
                "//span[contains(@data-qa, 'vacancy-serp__vacancy-address')]");
            if ($cityDom->count()) {
                $cityParts = explode(",", trim($cityDom->text()));

                $vacancy->city = $cityParts[0];
            }

            $dateDom = $dom->filterXPath(
                "//span[contains(@data-qa, 'vacancy-serp__vacancy-date')]");
            if ($dateDom->count()) {
                $dateParts = explode(" ", trim($dateDom->text()));

                $vacancy->date = Carbon::create(
                    (int) date("Y"),
                    self::$months[strtolower($dateParts[1])],
                    (int) $dateParts[0]
                );
            }

            call_user_func_array($callback, [$vacancy]);
        });
    }

    /**
     * @param string $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * @param int $pagesPerCity
     */
    public function setPagesPerCity($pagesPerCity)
    {
        $this->pagesPerCity = $pagesPerCity;
    }

    /**
     * @param int $pageNumber
     * @return string
     */
    protected function buildUrl($pageNumber, $cityId) {
        return sprintf($this->urlPattern,
            $cityId,
            $this->period,
            $pageNumber);
    }

    /**
     * @param array $cityIds
     */
    public function setCityIds($cityIds)
    {
        $this->cityIds = $cityIds;
    }
}
