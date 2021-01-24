<?php declare(strict_types=1);

namespace App\Framework;

use Dotenv\Dotenv;

class Application extends Container
{
    public function __construct(private string $basePath)
    {
        $this->loadEnvironmentVariables();
    }

    protected function loadEnvironmentVariables(): void
    {
        $dotenv = Dotenv::createImmutable($this->basePath);
        $dotenv->safeLoad();
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function run()
    {
        return 'Hello world?';
    }
}
