<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\models\News;

class newsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data  = News::all();

        return view('dashboard.news.list', ['data' => $data]);
    }

    public function add()
    {
        $action = 'Salvar';
        $route = "news.send.add";
        $icon = "fas fa-plus";

        return view('dashboard.news.form', [
            'data'   => [],
            'action' => $action,
            'route'  => $route,
            'icon' => $icon
        ]);
    }
    public function edit($id)
    {
        $data = News::find($id);
        $action = 'Editar';
        $route = "news.send.edit";
        $icon = "fas fa-edit";

        return view('dashboard.news.form', [
            'data'   => $data,
            'action' => $action,
            'route'  => $route,
            'icon' => $icon
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
            'title'     => $request->title,
            'subtitle'  => $request->subtitle,
            'slug'      => \Str::slug($request->title),
            'author'    => $request->author,
            'url_site'  => $request->url_site,
            'content'   => $request->content,
            'status'    => $status,
            'date'      => date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time))
        ];

        $new = new News;

        $data = $new->newsAdd($input);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {


            $nameFile = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            $input2 = [

                'imageNew'  => $nameFile
            ];

            $new->newsEdit($input2, $data->id);

            // Faz o upload:
            $upload = $request->image->storeAs('news/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $data->id, $nameFile, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();

            if (!empty($data->id)) {
                return \Redirect::route('news.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('news.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        } else {
            if (!empty($data->id)) {
                return \Redirect::route('news.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('news.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
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


        $input = [
            'title'     => $request->title,
            'subtitle'  => $request->subtitle,
            'slug'      => \Str::slug($request->title),
            /* 'slug'      => $request->tag, */
            'author'    => $request->author,
            'url_site'  => $request->url_site,
            'content'   => $request->content,
            'status'    => $status,
            'date'      => date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time))
        ];

        /*         $validator = $input->validate([
            'title'    => 'required',
            'subtitle' => 'required',
            'content'  => 'required'
        ]);

        if(empty($validator))
        {
            return $request->input();
        }
 */
        $new = new News;

        $data = $new->newsEdit($input, $request->id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {



            $nameFile = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            $input2 = [

                'imageNew'  => $nameFile
            ];

            $new->newsEdit($input2, $data->id);

            $old = 'news/' . $request->id . '/' . $request->imageOld;
            \Storage::disk('public')->delete($old);


            // Faz o upload:
            $upload = $request->image->storeAs('news/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $data->id, $nameFile, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();

            if (!empty($data->id)) {
                return \Redirect::route('news.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('news.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        } else {
            if (!empty($data->id)) {
                return \Redirect::route('news.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('news.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        }
    }

    public function delete($id)
    {
        $new = new News;
        $data = $new->newsDel($id);
        return $data;
    }
}
