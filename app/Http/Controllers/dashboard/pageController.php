<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SubMenu;

class pageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if ($request->page == 'factory') {
            $page = 'Usina';
        }
        $data = Submenu::where('tag', $request->page)->where('status', 1)->get();

        return view('dashboard.page.list', ['data' => $data, 'page' => $page]);
    }
}
