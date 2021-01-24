<?php declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class ChangePassword extends Controller
{
    public function showForm()
    {
        return $this->render('account/password-form');
    }

    public function change()
    {

    }
}
