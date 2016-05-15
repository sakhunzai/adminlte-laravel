<?php

namespace Acacha\AdminLTETemplateLaravel\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view(config("adminlte.homeView"));
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function profile(Request $request)
    {
        $user=Auth::user();
        $profile=($request->all());
        $mediaDir=config('adminlte.profileImgDir').'/';
        $avatar = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $profile['imagebase64']));
        preg_match('#^data:image/(\w+);base64,#i', $profile['imagebase64'],$match);

        $oldAvatar=trim($user->avatar) ? $mediaDir.$user->avatar : null;

        $user->avatar= strtotime('now').".{$match[1]}";

        if(file_put_contents($mediaDir.$user->avatar, $avatar)){
            if($oldAvatar && file_exists($oldAvatar)) unlink($oldAvatar);
            $user->save();
            $response = array(
                'status' => 'success',
                'avatar' => '/images/'.$user->avatar
            );
        }else{
            $response = array(
                'status' => 'fail',
            );
        }

        return response()->json($response);
    }

}