<?php declare(strict_types=1);

namespace App\Providers;

use PDO;
use App\Framework\ServiceProvider;

final class DatabaseProvider extends ServiceProvider
{
    public function register(): void
    {
        $pdo = new PDO($_ENV['DB_DSN'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        $this->app->addSingleton(PDO::class, $pdo);
    }
}
