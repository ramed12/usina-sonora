<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\LogInvestor;
use Illuminate\Http\Request;
use App\Models\Images;
use App\models\Company;
use App\models\Menu;
use App\models\SubMenu;
use App\models\Paramenter_Lgpd;
use App\models\File;

class investorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $filial = Company::find(2);
        $matriz = Company::find(1);
        $carousel = Images::where('gallery', 'carousel')->where('status', 1)->get();

        $menu = Menu::where('status', 1)->where('tag', 'pages')->whereNotIn('id', [6, 14, 7, 5, 3])->get();
        $submenu = SubMenu::where('status', 1)->orderby('position')->get();
        \View::share('carousel', $carousel);
        \View::share('filial', $filial);
        \View::share('matriz', $matriz);
        \View::share('facebook', $matriz->facebook);
        \View::share('twitter', $matriz->twitter);
        \View::share('instagram', $matriz->instagram);
        \View::share('instragram', $matriz->instagram);
        \View::share('linkedin', $matriz->linkedin);
        \View::share('googleplus', $matriz->googleplus);
        \View::share('maps', $matriz->maps);
        \View::share('menu', $menu);
        \View::share('submenu', $submenu);
    }

    public function index()
    {
        if (\Auth::check() != true && \Auth::user()->role != 2) {
            abort(404);
        }
        $log = new LogInvestor();

        $log->ip = $_SERVER['REMOTE_ADDR'];
        $log->user_id = \Auth::user()->id;
        $log->page = 'Página Inicial do Investidor';
        $log->save();

        $data = File::where('status', 1)->get();
        return view('site.investor.index', ['data' => $data]);
    }
    public function download($file_id)
    {
        if (\Auth::check() != true && \Auth::user()->role != 2) {
            abort(404);
        }

        $log = new LogInvestor();



        $file = File::find($file_id);
        $archive = public_path("/storage/investor/plan/") . $file->path;

        $log->ip = $_SERVER['REMOTE_ADDR'];
        $log->user_id = \Auth::user()->id;
        $log->page = $archive;
        $log->save();
        $Newname = md5('HisdmY');
        $headers = array(
            'Content-Type: application/pdf',
        );

        return \Response::download($archive, $Newname . '.pdf', $headers);
    }
}
