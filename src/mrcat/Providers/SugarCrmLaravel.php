<?php

namespace MrCat\SugarCrmLaravel\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use MrCat\SugarCrmLaravel\Auth\AuthSugarCrmGuard;
use MrCat\SugarCrmLaravel\Auth\AuthSugarCrmProvider;
use MrCat\SugarCrmOrmApi\Capsule\ManagerSugarCrm;
use MrCat\SugarCrmLaravel\Command\SugarCrmCommand;

class SugarCrmLaravel extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->getPublishes();
        $this->configSugarWrapper();
        $this->registerAuthGuard();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommand();
    }

    /**
     * Instance Manager
     */
    public function configSugarWrapper()
    {
        ManagerSugarCrm::config([
            'base_uri' => config('sugarcrm.api.base_uri'),
            'uri'      => config('sugarcrm.api.uri'),
            'timeout'  => 30.0,
        ]);
    }

    /**
     * publish files config
     */
    public function getPublishes()
    {
        $this->publishes([
            __DIR__ . '/../../../config/sugarcrm.php' => config_path('sugarcrm.php'),
        ]);
    }

    /**
     * Path Config
     *
     * @param $file
     * @return string
     */
    public function configPath($file)
    {
        return __DIR__ . '/../../../../../../config/' . $file;
    }


    /**
     * Register commands
     */
    public function registerCommand()
    {
        $this->commands([
            SugarCrmCommand::class,
        ]);
    }

    public function registerAuthGuard()
    {
        Auth::provider('sugar_crm_provider', function ($app, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
            return new AuthSugarCrmProvider();
        });

        Auth::extend('sugar_crm_guard', function ($app, $name, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\Guard...
            $guard = new AuthSugarCrmGuard(
                Auth::createUserProvider($config['provider']),
                $app['session'],
                $app['request']
            );

            // set cookie jar
            $guard->setCookieJar($app['cookie']);

            return $guard;
        });
    }
}
