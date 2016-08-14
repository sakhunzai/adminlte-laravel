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

        $data=['level'=>'danger','message'=>'Invalid verification code'];

        if($verification_code) {
            $user = User::whereVerificationCode($verification_code)->first();
            if($user){
                $user->is_verified++ ;
                $user->verification_code = null;
                $user->save();
                $data=['level'=>'success','message'=>'You have successfully verified your account'];
           }
        }

        \Session::flash('flash', $data);

        return view('adminlte::auth.verify');
    }

}
