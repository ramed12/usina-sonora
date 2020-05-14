<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Paramenter_Lgpd;

class lgpdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Paramenter_Lgpd::all();

        return view('dashboard.lgpd.list', ['data' => $data]);
    }

    public function add()
    {
        $action = 'Criar';
        $button = 'Salvar';
        $route = "lgpd.send.add";
        $icon = "fas fa-plus";

        return view('dashboard.lgpd.form', [
            'data'   => [],
            'action' => $action,
            'route'  => $route,
            'icon' => $icon,
            'button' => $button,
        ]);
    }

    public function edit($id)
    {
        $data = Paramenter_Lgpd::find($id);
        $action = 'Editar';
        $route = "lgpd.send.edit";
        $icon = "fas fa-edit";
        $button = $action;

        return view('dashboard.lgpd.form', [
            'data'   => $data,
            'action' => $action,
            'route'  => $route,
            'icon' => $icon,
            'button' => $button,
        ]);
    }

    public function store(Request $request)
    {

        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }


        $input = [
            'name'  => $request->name,
            'content'  => $request->content,
            'status' => $status,
            'slug' => \Str::slug($request->name, '-')
        ];

        $lgpd = new Paramenter_Lgpd;

        $data = $lgpd->paramenterLGPDAdd($input);

        if (!empty($data->id)) {
            return \Redirect::route('lgpd.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
        } else {
            return \Redirect::route('lgpd.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
        }
    }
    public function update(Request $request)
    {

        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }


        $input = [
            'name'  => $request->name,
            'content'  => $request->content,
            'status' => $status,
            'slug' => \Str::slug($request->name, '-')
        ];

        $lgpd = new Paramenter_Lgpd;

        $data = $lgpd->paramenterLGPDEdit($input, $request->id);

        if (!empty($data->id)) {
            return \Redirect::route('lgpd.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
        } else {
            return \Redirect::route('lgpd.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
        }
    }

    public function delete($id)
    {
        $lgpd = new Paramenter_Lgpd;
        $data = $lgpd->paramenterLGPDDel($id);

        return $data;
    }
}
