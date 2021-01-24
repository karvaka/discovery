<?php declare(strict_types=1);

namespace App;

use App\Framework\Application;
use App\Providers\DatabaseProvider;

final class Bootstrap
{
    public function createApplication(): Application
    {
        $app = new Application(dirname(__DIR__));

        $this->registerServices($app);

        return $app;
    }

    private function registerServices(Application $app): void
    {
        (new DatabaseProvider($app))->register();
    }
}
