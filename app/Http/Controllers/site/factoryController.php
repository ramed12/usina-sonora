<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\models\Images;
use Illuminate\Http\Request;
use App\models\SubMenu;

class factoryController extends Controller
{
    public function listPage($id)
    {
        $image = Images::where('gallery', 'journal')->get();
        $data = SubMenu::find($id);
        return view('site.page', ['data' => $data, 'image' => $image]);
    }
}
