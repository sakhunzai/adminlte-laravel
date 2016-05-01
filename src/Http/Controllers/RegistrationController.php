<?php
namespace Acacha\AdminLTETemplateLaravel\Http\Controllers;

use\Illuminate\Routing\Controller as BaseController;

class RegistrationController extends BaseController
{

    public function verify($verification_code)
    {

        if( ! $verification_code )
        {
            throw new InvalidVerificationCodeException;
        }

        $user = User::whereVerificationCode($verification_code)->first();

        if ( ! $user)
        {
            throw new InvalidVerificationCodeException;
        }

        $user->is_verified = 1;
        $user->verification_code = null;
        $user->save();

        \Session::flash('verify_success', 'You have successfully verified your account.');

        return Redirect::route('login_path');

    }
}
