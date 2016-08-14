<?php

namespace Acacha\AdminLTETemplateLaravel\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Default login view
     * @var string
     */
    protected $loginView = '';

    /**
     * Default register view
     * @var string
     */
    protected $registerView = '';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->loginView = config('adminlte.loginView');
        $this->registerView = config('adminlte.registerView');
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $register = config('adminlte.auth.register');

        if (!isset($register['validations'])) {
            $validations = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
            ];
        } else {
            $validations = $register['validations'];
        }

        // multi part name
        $data = $this->normalizeName($data, $register);
        $messages= isset($register['validation_messages']) ? $register['validation_messages'] : [];
        return Validator::make($data, $validations,$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $register = config('adminlte.auth.register');

        $data = $this->normalizeName($data, $register);

        $new_user = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => $register['default_user_type'],
        ];


        //if user name is multi part
        if (isset($register['name'])) {
            $new_user = array_merge($new_user, array_intersect_key($data, $register['name']));
        }

        //if extra field to be captured
        if (isset($register['extra_fields']) && count($register['extra_fields'])) {
            $extra = array_combine($register['extra_fields'], array_fill(0, count($register['extra_fields']), null));
            $new_user = array_merge($new_user, array_intersect_key($data, $extra));
        }


        if ($register['verification']['enabled']) {

            $verification_code = str_random($register['verification']['token_length']);

            $new_user = array_merge($new_user, [
                    'verification_code' => $verification_code,
                    'is_verified' => '0']
            );

            $user = User::create($new_user);

        } else {
            $user = User::create($new_user);
        }

        return $user;
    }


    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        $redirect = config('adminlte.auth.register.redirect');

        if ($redirect['autologin']){
            Auth::guard($this->getGuard())->login($user);
            $message="Welcome ".$user->name;
        }
        else
           $message=config('adminlte.auth.register.verification.thankyou','You are registered successfully.');

        $flash =['flash' => ['message' => $message, 'level' => 'success']];

        if (isset($redirect['route']))
            return redirect($redirect['route'])->with($flash);
        else
            return redirect($this->redirectPath())->with($flash);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $credentials = $request->only($this->loginUsername(), 'password');

        if (config('adminlte.auth.loginOnlyVerifiedUsers')) {
            $credentials['is_verified'] = config('adminlte.auth.is_verified_equal');
            $credentials['is_blocked']  = 0;
        }

        return $credentials;
    }

    private function normalizeName($data, $config = [])
    {
        $config = count($config) ? $config : config('adminlte.auth.register');

        if (isset($config['name'])) {
            $full_name = array_intersect_key($data, $config['name']);
            $data['name'] = join(' ', array_filter($full_name));
        }

        return $data;
    }

    protected function authenticated($request, $user)
    {
        //check  user account is verified
        $verified=$this->isVerified($user);

        if($verified!==true) return $verified;

        //check user is not blocked
        $isNotBlocked=$this->isNotBlocked($user);

        if($isNotBlocked!==true) return $isNotBlocked;


        $redirect = config('adminlte.auth.login.redirect', []);

        $redirectTo = '';
        if (isset($redirect['enabled']) && $redirect['enabled'] == true) {
            $class = config('adminlte.auth.login.redirect.handler');
            $interface = "Acacha\\AdminLTETemplateLaravel\\Contracts\\LoginRedirectContract";
            $handler = new $class;
            if ($handler instanceof $interface) {
                $redirectTo = $handler->getRedirect($user);
            } else {
                throw new BindingResolutionException;
            }
        }

        $redirectTo = $redirectTo == '' ? $this->redirectPath() : $redirectTo;
        return redirect()->intended($redirectTo);
    }

    protected function isVerified($user)
    {
        // user email not verified
        if ($user->is_verified !== config('adminlte.auth.is_verified_equal') &&  $user->verification_code != '') {

            return back()->withErrors(
                [
                    $this->loginUsername() => 'You need to verify your account. We have sent you an activation link, please check your email.'
                ]
            );
            // user is not verified by admin
        }else  if ($user->is_verified !== config('adminlte.auth.is_verified_equal')) {

            return back()->withErrors(
                [
                    $this->loginUsername() => 'Your account is being verified, please check later.'
                ]
            );

        }
        // all verified
        return true;
    }

    protected function isNotBlocked($user)
    {
        if ($user->is_blocked!=0) {

            return back()->withErrors(
                [
                    $this->loginUsername() =>  'Your account is blocked, please contact administrator for further information.',
                ]
            );
        }

        return true;
    }
}
