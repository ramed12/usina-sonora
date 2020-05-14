<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SubMenu;
use App\models\Menu;

class policyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $page = 'Política';
        $action = 'Editar';
        $data = Menu::find($id);
        $route = "policy.send.edit";
        $icon = "far fa-edit";
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
            return \Redirect()->route('policy.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Atualizado']);
        } else {
            return \Redirect()->route('policy.edit', ['id' =>  $request->id])->with(['icon' => 'error', 'message' => 'Erro ao atualizar']);
        }
    }
    public function delete($id)
    {
        $menu = new Menu;
        $data = $menu->menuDel($id);
        return $data;
    }
}
