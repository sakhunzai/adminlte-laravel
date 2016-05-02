<?php

namespace Acacha\AdminLTETemplateLaravel;

use App\User;

use Acacha\AdminLTETemplateLaravel\Contracts\LoginRedirectContract;

class LoginRedirect implements LoginRedirectContract
{

    /**
     * @param User $user
     * @return mixed
     */
    public function getRedirect($user)
    {
        return '';
    }

}