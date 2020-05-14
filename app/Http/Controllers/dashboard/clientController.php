<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Menu;

class clientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $page = 'Cliente';
        $action = 'Editar';
        $route = "client.send.edit";
        $icon = "far fa-edit";
        $data  = Menu::find($id);

        return view('dashboard.page.form', [
            'data' => $data, 'page' => $page,
            'action' => $action, 'menu' => [],
            'route' => $route, 'icon' => $icon
        ]);
    }

    public function update(Request $request)
    {

        $menu = new Menu;

        $update = $menu->updateMenu($request);

        if ($update > 0) {
            return \Redirect()->route('client.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Atualizado']);
        } else {
            return \Redirect()->route('client.edit', ['id' =>  $request->id])->with(['icon' => 'error', 'message' => 'Erro ao atualizar']);
        }
    }

    public function delete($id)
    {
        $menu = new Menu;
        $data = $menu->menuDel($id);
        return $data;
    }
}
