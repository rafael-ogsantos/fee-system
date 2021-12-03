<?php

namespace App\Console\Commands;

use App\Outsource\ApiLocales;
use Illuminate\Console\Command;

class ImportCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import cities from my state';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cities = (new ApiLocales)->getCities();

        foreach($cities as $city) {
            dump($city['nome']);
        }
    }
}
