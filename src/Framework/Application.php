<?php declare(strict_types=1);

namespace App\Framework;

use Dotenv\Dotenv;

class Application extends Container
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;

        $this->loadEnvironmentVariables();
    }

    protected function loadEnvironmentVariables(): void
    {
        $dotenv = Dotenv::createImmutable($this->basePath);
        $dotenv->safeLoad();
    }

    public function run()
    {
        return 'Hello world?';
    }
}
