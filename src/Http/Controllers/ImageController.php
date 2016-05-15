<?php
namespace Acacha\AdminLTETemplateLaravel\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getImage($filename) {
        $img = config('adminlte.profileImgDir').'/'.$filename;

        $img=file_exists($img) ? $img : public_path(config('adminlte.profileImg'));
        $type = "image/". pathinfo($img,PATHINFO_EXTENSION);
        header('Content-Type:'. $type);
        header('Content-Length: ' . filesize($img));
        return readfile($img);
    }

}
