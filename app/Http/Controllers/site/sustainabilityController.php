<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Submenu;

class sustainabilityController extends Controller
{
    public function listPage($id)
    {
        $data = SubMenu::find($id);
        return view('site.page', ['data' => $data]);
    }
}
