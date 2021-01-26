<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Framework\PerformsRedirections;
use App\Framework\RendersViews;

abstract class Controller
{
    use RendersViews, PerformsRedirections;

    public function getViewsBasePath(): string
    {
        // TODO retrieve from config
        return dirname(dirname(dirname(__DIR__))) . '/resources/views';
    }

    public function getLayout(): ?string
    {
        return 'layouts/app';
    }
}
