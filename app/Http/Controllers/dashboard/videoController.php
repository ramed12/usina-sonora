<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\images as Images;
use Illuminate\Support\Facades\Validator;

class videoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function list()
    {

        $page = "Galeria de Imagens - Vídeos";
        $action = 'Salvar';
        $route = "gallery.video";
        $icon = "fas fa-plus";
        $gallery = 'video';

        $data = Images::where('gallery', 'video')->get();
        return view('dashboard.gallery.list', ['data' => $data, 'page' => $page, 'route' => $route, 'gallery' => $gallery]);
    }

    public function add()
    {
        $page = "Galeria de Imagens";
        $action = 'Salvar';
        $route = "gallery.video.add";
        $route2 = "gallery.video";
        $gallery = 'video';
        $icon = "fas fa-plus";
        return view('dashboard.gallery.form', [
            'data'   => [],
            'action' => $action,
            'route'  => $route,
            'route2'  => $route2,
            'gallery'  => $gallery,
            'page'  => $page,
            'icon' => $icon
        ]);
    }

    public function edit($id)
    {
        $page = "Galeria de Vídeos";
        $action = 'Editar';
        $route = "gallery.video.send.edit";
        $route2 = "gallery.video";
        $gallery = 'video';
        $icon = "fas fa-edit";
        $data = Images::find($id);

        return view('dashboard.gallery.form', [
            'data'    => $data,
            'action'     => $action,
            'route'      => $route,
            'route2'     => $route2,
            'gallery'    => $gallery,
            'page'       => $page,
            'icon'       => $icon
        ]);
    }

    public function store(Request $request)
    {
        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes: jpg, jpeg,png,gif,mp4',
            'poster' => 'required|mimes: jpg, jpeg,png,gif,mp4'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!empty($request->file('image'))) {
            $nameFile = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $path = "{$name}.{$extension}";
            $type = $extension;
        } else {
            $path = $request->image;
            $type = 'youtube';
        }



        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {

            if (!empty($request->file('poster'))) {
                $nameFile1 = null;

                // Define um aleatório para o arquivo baseado no timestamps atual
                $name1 = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension1 = $request->file('poster')->extension();

                // Define finalmente o nome
                $path1 = "{$name1}.{$extension1}";
                $type1 = $extension1;
            }


            $upload = $request->image->storeAs('gallery/video/poster/', $path1, 'public');
        }


        $input = [
            'name' => $request->name,
            'position' => $request->position,
            'status' => $status,
            'path' => $path,
            'type' => $type,
            'gallery' => $request->gallery,
            'category' => $request->category,
            'description' => $request->description,
            'poster' => $path1
        ];


        $image = new Images;

        $data = $image->imageAdd($input);


        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // Faz o upload:
            $upload = $request->image->storeAs('gallery/video/', $path, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();

            if (!empty($data->id)) {
                return \Redirect::route('gallery.' . $request->gallery . '.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('gallery.' . $request->gallery . '.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        } else {
            if (!empty($data->id)) {
                return \Redirect::route('gallery.' . $request->gallery . '.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('gallery.' . $request->gallery . '.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        }
    }

    public function update(Request $request)
    {
        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes: jpg, jpeg,png,gif,mp4',
            'poster' => 'required|mimes: jpg, jpeg,png,gif,mp4'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }



        if (!empty($request->file('image'))) {
            $nameFile = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $path = "{$name}.{$extension}";
            $type = $extension;
        } else {
            $path = $request->path;
            $type = 'youtube';
        }

        $input = [
            'name' => $request->name,
            'position' => $request->position,
            'status' => $status,
            'path' => $path,
            'type' => $type,
            'gallery' => $request->gallery,
            'category' => $request->category,
            'description' => $request->description
        ];

        $image = new Images;

        $data = $image->imageEdit($input, $request->id);
        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {

            if (!empty($request->file('poster'))) {
                $nameFile1 = null;

                // Define um aleatório para o arquivo baseado no timestamps atual
                $name1 = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension1 = $request->file('poster')->extension();

                // Define finalmente o nome
                $path1 = "{$name1}.{$extension1}";
                $type1 = $extension1;
            }

            $oldPoster = 'gallery/video/poster' . $request->posterOld;
            \Storage::disk('public')->delete($oldPoster);


            $upload = $request->image->storeAs('gallery/video/poster/', $path1, 'public');
        }



        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $old = 'gallery/video/' . $request->imageOld;
            \Storage::disk('public')->delete($old);
            // Faz o upload:
            $upload = $request->image->storeAs('gallery/video', $path, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();

            if (!empty($data->id)) {
                return \Redirect::route('gallery.' . $request->gallery . '.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('gallery.' . $request->gallery . '.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        } else {
            if (!empty($data->id)) {
                return \Redirect::route('gallery.' . $request->gallery . '.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('gallery.' . $request->gallery . '.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        }
    }

    public function delete($id)
    {
        $image = new Images;
        $data = $image->imagesDel($id);
        return $data;
    }
}
