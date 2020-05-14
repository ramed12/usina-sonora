<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\models\Departament;

class departamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Departament::all();

        return view('dashboard.departament.list', ['data' => $data]);
    }

    public function add()
    {
        $action = 'Criar';
        $route = "departament.send.add";
        $icon = "fas fa-plus";

        return view('dashboard.departament.form', [
            'data'   => [],
            'action' => $action,
            'route'  => $route,
            'icon' => $icon,
        ]);
    }

    public function edit($id)
    {
        $data = Departament::find($id);
        $action = 'Editar';
        $route = "departament.send.edit";
        $icon = "fas fa-edit";

        return view('dashboard.departament.form', [
            'data'   => $data,
            'action' => $action,
            'route'  => $route,
            'icon' => $icon,
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
            'email'  => $request->email,
            'status' => $status
        ];

        // $validator = $input->validate([
        //     'name'    => 'required',
        //     'email' => 'required'
        // ]);

        // if(empty($validator))
        // {
        //     return $request->input();
        // }

        $departament = new Departament;

        $data = $departament->departamentAdd($input);

        if (!empty($data->id)) {
            return \Redirect::route('departament.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
        } else {
            return \Redirect::route('departament.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
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
            'email'  => $request->email,
            'status' => $status
        ];

        // $validator = $input->validate([
        //     'name'    => 'required',
        //     'email' => 'required'
        // ]);

        // if(empty($validator))
        // {
        //     return $request->input();
        // }

        $departament = new Departament;

        $data = $departament->departamentEdit($input, $request->id);

        if (!empty($data->id)) {
            return \Redirect::route('departament.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
        } else {
            return \Redirect::route('departament.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
        }
    }

    public function delete($id)
    {
        $departament = new Departament;
        $data = $departament->departamentDel($id);

        return $data;
    }
}
