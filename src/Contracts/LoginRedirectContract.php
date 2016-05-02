<?php

namespace Acacha\AdminLTETemplateLaravel\Contracts;

use App\User;

interface LoginRedirectContract
{
    /**
     * @param User $user
     * @return mixed
     */
    public function getRedirect($user);
}