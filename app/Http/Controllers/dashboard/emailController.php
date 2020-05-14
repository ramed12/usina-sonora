<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Paramenter_Email;

class emailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Paramenter_Email::all();

        return view('dashboard.email.list', ['data' => $data]);
    }

    public function add()
    {
        $action = 'Criar';
        $route = "email.send.add";
        $icon = "fas fa-plus";
        $button = 'Salvar';

        return view('dashboard.email.form', [
            'data'   => [],
            'action' => $action,
            'route'  => $route,
            'icon' => $icon,
            'button' => $button
        ]);
    }

    public function edit($id)
    {
        $data = Paramenter_Email::find($id);
        $action = 'Editar';
        $route = "email.send.edit";
        $icon = "fas fa-edit";
        $button = $action;

        return view('dashboard.email.form', [
            'data'   => $data,
            'action' => $action,
            'route'  => $route,
            'icon' => $icon,
            'button' => $button
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
            'status' => $status
        ];

        $email = new Paramenter_Email;

        $data = $email->paramenterEmailAdd($input);

        if (!empty($data->id)) {
            return \Redirect::route('email.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
        } else {
            return \Redirect::route('email.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
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
            'status' => $status
        ];

        $email = new Paramenter_Email;

        $data = $email->paramenterEmailEdit($input, $request->id);

        if (!empty($data->id)) {
            return \Redirect::route('email.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
        } else {
            return \Redirect::route('email.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
        }
    }

    public function delete($id)
    {
        $email = new Paramenter_Email;
        $data = $email->paramenterEmailDel($id);

        return $data;
    }
}
