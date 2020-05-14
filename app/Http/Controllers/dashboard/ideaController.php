<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Idea;
use App\models\Departament;

class ideaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Idea::all();
        $departament = Departament::where('status', 1)->get();

        $page = "Caixa de Idéias";

        return view('dashboard.idea.list', ['data' => $data, 'page' => $page, 'departament' => $departament]);
    }

    public function show($id)
    {
        $data = Idea::find($id);
        $departament = Departament::where('status', 1)->get();

        return view('dashboard.idea.form', ['data' => $data, 'departament' => $departament]);
    }

    public function delete($id)
    {
        $idea = new Idea;
        $data = $idea->del($id);
        return $data;
    }
}
