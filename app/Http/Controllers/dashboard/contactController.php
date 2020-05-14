<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Menu;
use App\models\Contact;
use App\models\Departament;

class contactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data  = Contact::all();

        return view('dashboard.contact.list', ['data' => $data]);
    }
    public function editPage($id)
    {

        $page = 'Contato';
        $action = 'Editar';
        $route = "contact.send.edit";
        $icon = "far fa-edit";
        $data  = Menu::find($id);

        return view('dashboard.page.form', [
            'data' => $data, 'page' => $page,
            'action' => $action, 'menu' => [],
            'route' => $route, 'icon' => $icon
        ]);
    }

    public function edit($id)
    {
        $departament = Departament::all();

        $data = Contact::find($id);
        $action = 'Editar';
        $route = "contact.send.edit";
        $icon = "fas fa-edit";

        return view('dashboard.contact.form', [
            'data'   => $data,
            'action' => $action,
            'route'  => $route,
            'icon' => $icon,
            'departament' => $departament
        ]);
    }

    public function update(Request $request)
    {
    }

    public function updatePage(Request $request)
    {

        $menu = new Menu;

        $update = $menu->updateMenu($request);

        if ($update > 0) {
            return \Redirect()->route('contact.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Atualizado']);
        } else {
            return \Redirect()->route('contact.edit', ['id' =>  $request->id])->with(['icon' => 'error', 'message' => 'Erro ao atualizar']);
        }
    }

    public function delete($id)
    {
        $contact = new Contact;
        $data = $contact->contactDel($id);
        return $data;
    }
}
