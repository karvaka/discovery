<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class Register extends Controller
{
    public function showForm()
    {
        return $this->render('auth/register');
    }

    public function register()
    {

    }
}
