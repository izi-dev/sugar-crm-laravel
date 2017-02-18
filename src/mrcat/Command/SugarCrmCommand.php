<?php

namespace MrCat\SugarCrmLaravel\Command;

use Illuminate\Console\Command;
use MrCat\SugarCrmLaravel\Providers\SugarCrmLaravel;
use Tymon\JWTAuth\Providers\JWTAuthServiceProvider;

class SugarCrmCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sugarcrm:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install package sugarcrm';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--provider' => SugarCrmLaravel::class
        ]);
    }
}