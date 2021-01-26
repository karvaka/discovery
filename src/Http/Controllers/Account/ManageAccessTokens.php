<?php declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class ManageAccessTokens extends Controller
{
    public function index()
    {
        return $this->render('account/access-tokens-list', layout: 'layouts/app');
    }
}
