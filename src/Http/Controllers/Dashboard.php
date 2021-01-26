<?php declare(strict_types=1);

namespace App\Http\Controllers;

class Dashboard extends Controller
{
    public function show()
    {
        return $this->render('dashboard', layout: 'layouts/app');
    }
}
