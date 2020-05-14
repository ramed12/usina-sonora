<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SubMenu;
use App\models\Menu;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $page = 'Produto';
        $route = 'product';
        $data = SubMenu::where('tag', 'product')->where('status', 1)->get();

        return view('dashboard.page.list', ['data' => $data, 'page' => $page, 'route' => $route]);
    }

    public function add()
    {
        $page = 'Usina';
        $action = 'Salvar';
        $route = "product.send.add";
        $icon = "far fa-save";
        $tag = 'product';
        $menu  = Menu::all();

        return view('dashboard.page.form', [
            'data' => [], 'page' => $page,
            'action' => $action, 'menu' => $menu,
            'route' => $route, 'icon' => $icon, 'tag' => $tag
        ]);
    }

    public function edit($id)
    {
        $page = 'Produto';
        $action = 'Editar';
        $data = SubMenu::find($id);
        $route = "product.send.edit";
        $icon = "far fa-edit";
        $menu  = Menu::all();

        return view('dashboard.page.form', [
            'data' => $data, 'page' => $page,
            'action' => $action, 'menu' => $menu,
            'route' => $route, 'icon' => $icon
        ]);
    }

    public function store(Request $request)
    {

        $SubMenu = new SubMenu;

        $input = [
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'status' => $request->status,
            'content' => $request->content,
            'menu_id' => $request->menu_id,
            'tag' => $request->tag,
            'position' => $request->position
        ];

        $validator = Validator::make($request->all(), [
            'image' => 'mimes: jpg, jpeg,png,gif,mp4',
            'file' => 'mimes: pdf,docx,doc'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = $SubMenu->SubMenuAdd($input);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $nameFile2 = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->file->extension();

            // Define finalmente o nome
            $nameFile2 = "{$name}.{$extension}";

            $input3 = [

                'file'  => $nameFile2
            ];
            $SubMenu->updateSubMenu($input3, $update->id);


            // Faz o upload:
            $upload = $request->file->storeAs('document/', $nameFile2, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $nameFile = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            $input2 = [

                'image'  => $nameFile
            ];

            $SubMenu->updateSubMenu($input2, $update->id);

            // Faz o upload:
            $upload = $request->image->storeAs('gallery/page/', $nameFile, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();

            if ($update->id > 0) {
                return \Redirect::route('product.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('product.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        } else {

            if ($update->id > 0) {
                return \Redirect()->route('product.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect()->route('product.add')->with(['icon' => 'error', 'message' => 'Erro ao Salvo']);
            }
        }
    }

    public function update(Request $request)
    {

        $SubMenu = new SubMenu;

        $input = [
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'status' => $request->status,
            'content' => $request->content
        ];
        $validator = Validator::make($request->all(), [
            'image' => 'mimes: jpg, jpeg,png,gif,mp4',
            'file' => 'mimes: pdf,docx,doc'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = $SubMenu->updateSubMenu($input, $request->id);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $nameFile2 = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->file->extension();

            // Define finalmente o nome
            $nameFile2 = "{$name}.{$extension}";

            $input3 = [

                'file'  => $nameFile2
            ];
            $SubMenu->updateSubMenu($input3, $request->id);

            if (!empty($request->fileOld)) {
                $old = 'document/' . $request->fileOld;
                \Storage::disk('public')->delete($old);
            }

            // Faz o upload:
            $upload = $request->file->storeAs('document/', $nameFile2, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            $input2 = [

                'image'  => $nameFile
            ];

            $SubMenu->updateSubMenu($input2, $request->id);
            if (!empty($request->imageOld)) {
                $old = 'gallery/page/' . $request->imageOld;
                \Storage::disk('public')->delete($old);
            }

            // Faz o upload:
            $upload = $request->image->storeAs('gallery/page/', $nameFile, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();

            if ($update > 0) {
                return \Redirect::route('factory.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('factory.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        } else {


            if ($update > 0) {
                return \Redirect()->route('factory.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Atualizado']);
            } else {
                return \Redirect()->route('factory.edit', ['id' =>  $request->id])->with(['icon' => 'error', 'message' => 'Erro ao atualizar']);
            }
        }
    }
    public function delete($id)
    {
        $SubMenu = new SubMenu;
        $data = $SubMenu->SubMenuDel($id);
        return $data;
    }
}
