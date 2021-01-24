<?php declare(strict_types=1);

namespace App\Providers;

use App\Framework\ServiceProvider;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

final class FilesystemProvider extends ServiceProvider
{
    public function register(): void
    {
        $adapter = new LocalFilesystemAdapter($this->app->getBasePath());
        $filesystem = new Filesystem($adapter);

        $this->app->addSingleton(Filesystem::class, $filesystem);
    }
}
