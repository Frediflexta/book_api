<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\FetchExternalApiInterface;

class FetchExternalData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from the Fire&Ice Api';

    protected $fetchApiService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FetchExternalApiInterface $fetchApiService)
    {
        parent::__construct();
        $this->fetchApiService = $fetchApiService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Fetching data...🚀');

        $this->fetchApiService->fetchIceAndFire();

        $this->info('Data fetched successfully⌛');
    }
}
