<?php
namespace Acacha\AdminLTETemplateLaravel\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use\Illuminate\Routing\Controller as BaseController;

class RegistrationController extends BaseController
{
    use RedirectsUsers;

    public function verify($verification_code)
    {

        if( ! $verification_code )
        {
            throw new \Exception('Invalid verification code');
        }

        $user = User::whereVerificationCode($verification_code)->first();

        if ( ! $user)
        {
            throw new \Exception('Invalid verification code');
        }

        $user->is_verified = 1;
        $user->verification_code = null;
        $user->save();

        \Session::flash('verify_success', 'You have successfully verified your account.');

        return redirect($this->redirectPath());

    }
}
