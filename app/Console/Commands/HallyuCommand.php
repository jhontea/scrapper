<?php

namespace App\Console\Commands;

use App\Services\Hallyu\HallyuScrapeService;
use App\Traits\ScraperTrait;
use Illuminate\Console\Command;

class HallyuCommand extends Command
{
    use ScraperTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hallyu:visit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(HallyuScrapeService $hallyuScrapeService)
    {
        parent::__construct();
        $this->hallyuScrapeService = $hallyuScrapeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = '5-second-lead-couple-yang-tak-kalah-manis-dari-first-lead-couple';
        $count = 100;

        $start = microtime(true);
        $visit = $daily = $this->hallyuScrapeService->visitUrl($url, $count);
        $time_elapsed_secs = microtime(true) - $start;
        
        dd('Visit: '.$visit, 'Time(second): '.$time_elapsed_secs);
    }
}
