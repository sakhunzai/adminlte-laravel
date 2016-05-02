<?php

namespace  Acacha\AdminLTETemplateLaravel\Http\Controllers\Auth;

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
        $this->loginView=config('adminlte.loginView'); 
        $this->registerView=config('adminlte.registerView'); 
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      $register=config('adminlte.auth.register');

      if(!isset($register['validations'])){
          $validations=[
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
                ];
       }else{
          $validations=$register['validations'];
      }
        
        // multi part name
        $data=$this->normalizeName($data,$register);
        return Validator::make($data,$validations);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $register=config('adminlte.auth.register');
        
        $data=$this->normalizeName($data,$register);

        $new_user=[
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => $register['default_user_type'],
        ];
        

        //if user name is multi part
        if(isset($register['name'])){
            $new_user=array_merge($new_user, array_intersect_key($data,$register['name'])); 
        }        
        
        //if extra field to be captured
        if(isset($register['extra_fields']) && count($register['extra_fields'])){
            $extra= array_combine($register['extra_fields'],array_fill(0, count($register['extra_fields']), null));
            $new_user=array_merge($new_user, array_intersect_key($data, $extra)); 
        }        
        

        if( $register['verification']['enabled'] ){

            $verification_code= str_random($register['verification']['token_length']);

            $new_user= array_merge($new_user,[
                 'verification_code' => $verification_code,
                 'is_verified'=> '0']
            );

           $user=User::create($new_user);

           \Session::flash('register_success', $register['verification']['thankyou']);

        }else{
            $user=User::create($new_user);
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

       $user= $this->create($request->all());

       $redirect= config('adminlte.register.redirect');

       if($redirect['autologin'])  Auth::guard($this->getGuard())->login($user);

       if(isset($redirect['redirect']))
          return redirect($redirect['redirect']);
       else
          return redirect($this->redirectPath());
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $credentials = $request->only($this->loginUsername(), 'password');

        if(config('adminlte.auth.loginOnlyVerifiedUsers')){
            $credentials['is_verified']= 1;
        }

        return $credentials;
    }

    private function normalizeName($data,$config=[]){
        
        $config=count($config) ? $config : config('adminlte.auth.register');
        
        if(isset($config['name'])){
          $full_name= array_intersect_key($data,$config['name']);
          $data['name']=join(' ',array_filter($full_name));
        }
        
        return $data;
    }
    
    protected function authenticated($request, $user)
    {
        $redirect=config('adminlte.auth.login.redirect',[]);

        $redirectTo='';
        if (isset($redirect['enabled']) && $redirect['enabled']==true ) {
            $handler= app("AdminLTELoginRedirect");
            $redirectTo=$handler->getRedirect($user);
        }

        $redirectTo=$redirectTo=='' ? $this->redirectPath() :$redirectTo ;
        return redirect()->intended($redirectTo);
    }
}
