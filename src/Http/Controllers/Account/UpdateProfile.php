<?php declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class UpdateProfile extends Controller
{
    public function showForm()
    {
        return $this->render('account/profile-form', layout: 'layouts/app');
    }

    public function update()
    {

    }
}
