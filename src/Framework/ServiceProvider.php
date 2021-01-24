<?php declare(strict_types=1);

namespace App\Framework;

abstract class ServiceProvider
{
    public function __construct(
        protected Application $app
    )
    {

    }

    public abstract function register(): void;
}
