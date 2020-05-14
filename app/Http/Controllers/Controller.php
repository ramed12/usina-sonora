<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\models\images as Images;
use App\models\Company;
use App\models\Menu;
use App\models\SubMenu;
use App\models\Paramenter_Lgpd;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {

        $menu = Menu::where('status', 1)->where('tag', 'pages')->whereNotIn('id', [6, 14, 7, 5, 3])->get();
        $submenu = SubMenu::where('status', 1)->orderby('position')->get();

        $filial = Company::find(2);
        $matriz = Company::find(1);
        $carousel = Images::where('gallery', 'carousel')->where('status', 1)->orderby('position')->get();


        \View::share('carousel', $carousel);
        \View::share('menu', $menu);
        \View::share('submenu', $submenu);
        \View::share('filial', $filial);
        \View::share('matriz', $matriz);
        \View::share('facebook', $matriz->facebook);
        \View::share('twitter', $matriz->twitter);
        \View::share('instagram', $matriz->instagram);
        \View::share('linkedin', $matriz->linkedin);
        \View::share('googleplus', $matriz->googleplus);
        \View::share('maps', $matriz->maps);
    }
}
