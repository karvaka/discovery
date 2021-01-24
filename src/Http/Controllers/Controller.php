<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Framework\PerformsRedirections;
use App\Framework\RendersViews;

abstract class Controller
{
    use RendersViews, PerformsRedirections;
}
