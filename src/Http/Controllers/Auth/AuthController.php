<?php

namespace  Acacha\AdminLTETemplateLaravel\Http\Controllers\Auth;

use App\User;
use Validator;
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
        }
        
        // multi part name
        $data=$this->normalizeName($data,$register);
        return Validator::make($data,$register['validations']);
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
        ];
        
        if(isset($register['name'])){
            $data=array_merge($data, array_intersect_key($data,$register['name'])); 
        }        
        
        return User::create($data);
    }
    
    private function normalizeName($data,$config=[]){
        
        $config=count($config) ? $config : config('adminlte.auth.register');
        
        if(isset($config['name'])){
          $full_name= array_intersect_key($data,$config['name']);
          $data['name']=join(' ',array_filter($full_name));
        }
        
        return $data;
    }
}
