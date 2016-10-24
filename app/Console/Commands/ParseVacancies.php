<?php

namespace App\Console\Commands;

use App\Parser\Parser;
use App\Parser\VacancyInfo;
use App\Vacancy;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

const RECORD_IS_EXISTS_CODE = 23000;

class ParseVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:vacancies 
        {--pages-per-city=: count pages for parse} 
        {--period=1: 1/3/7/none – today/last three days/last week/last month}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse hh.ru vacancies';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $parser = new Parser();
        $parser->setPeriod($this->option('period'));
        $parser->setPagesPerCity((int) $this->option('pages-per-city'));

        $createdCount = 0;
        $updatedCount = 0;

        $parser->parse(function (VacancyInfo $vacancyInfo) use (& $createdCount, & $updatedCount) {
            try {
                Vacancy::create($vacancyInfo->toArray());
                $createdCount++;
            } catch (QueryException $e) {
                if ($e->getCode() != RECORD_IS_EXISTS_CODE) {
                    throw $e;
                }

                Vacancy::whereExternalId($vacancyInfo->external_id)->update($vacancyInfo->toArray());
                $updatedCount++;
            }
        });

        $this->info("Created vacancies: {$createdCount}");
        $this->info("Updated vacancies: {$updatedCount}");
    }
}
