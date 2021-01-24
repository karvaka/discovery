<?php declare(strict_types=1);

namespace Tests;

use App\Framework\Application;

trait CreatesApplication
{
    protected ?Application $app = null;

    public function createApplication(): Application
    {
        require __DIR__ . '/../vendor/autoload.php';

        return new Application();
    }

    public function setUpApplication(): void
    {
        $this->app = $this->createApplication();
    }

    public function tearDownApplication(): void
    {
        $this->app = null;
    }
}
