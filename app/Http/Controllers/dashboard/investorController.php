<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Menu;
use App\User;
use App\models\Paramenter_Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\models\File;

class investorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    public function list()
    {

        $data = User::where('role', 2)->get();
        return view('dashboard.investor.list', ['data' => $data]);
    }

    public function add()
    {
        $action = 'Criar';
        $route = "investor.send.add";
        $icon = "fas fa-plus";
        $role = 2;

        return view('dashboard.investor.form', [
            'data'   => [],
            'action' => $action,
            'route'  => $route,
            'icon' => $icon,
            'role' => $role
        ]);
    }

    public function edit($id)
    {

        $action = 'Editar';
        $route = "investor.send.edit";
        $icon = "fas fa-plus";
        $data = User::find($id);

        return view('dashboard.investor.form', [
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
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => $request->password,
            'status'     => $status,
            'role'       => $request->role,
        ];
        /*
        $validator = $input->validate([
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'password'  => 'required',
            'status'    => 'required'
        ]);

        if(empty($validator))
        {
            return $request->input();
        } */

        $user = new User;

        $data = $user->userAdd($user);
        if (!empty($data->id)) {
            return \Redirect::route('investor.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
        } else {
            return \Redirect::route('investor.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
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
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => $request->password,
            'status'     => $status,
            'role'       => $request->role,
        ];

        /*    $validator = $input->validate([
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'password'  => 'required',
            'status'    => 'required'
        ]);

        if(empty($validator))
        {
            return $request->input();
        } */

        $user = new User;
        $data = $user->userEdit($input, $request->id);

        if (!empty($data->id)) {
            return \Redirect::route('investor.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
        } else {
            return \Redirect::route('investor.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
        }
    }

    public function activePassword(Request $request)
    {


        $data = User::where('id', $request->id)->update([
            'status'    => 1,
            'password' => Hash::make($request->password)
        ]);

        $email = Paramenter_Email::where('id', 1)->where('status', 1)->first();

        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'content_email' => $email->content,
            'password'   => $request->password
        ];

        Mail::send(new \App\Mail\investorActivePasswordSender($input));

        return $data;
    }

    public function activeSendPasswordFile($id)
    {


        $data = User::find($id);

        $email = Paramenter_Email::where('id', 6)->where('status', 1)->first();

        $input = [
            'name' => $data->name,
            'email' => $data->email,
            'content_email' => $email->content,
            'password'   => '123123'
        ];

        Mail::send(new \App\Mail\investorPasswordFileSend($input));

        if (!empty($data->id)) {
            return \Redirect::route('investor')->with(['icon' => 'success', 'message' => 'Dados Enviado']);
        } else {
            return \Redirect::route('investor')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
        }
    }

    public function delete($id)
    {
        $new = new User;
        $data = $new->userDel($id);
        return $data;
    }

    //Lançar planilha de investidor
    public function listFile()
    {
        $data = File::all();

        return view('dashboard.investor.file.list', ['data' => $data]);
    }

    public function addFile()
    {
        $action = 'Criar';
        $route = "investor.file.send.add";
        $icon = "fas fa-plus";

        return view('dashboard.investor.file.form', [
            'data'   => [],
            'action' => $action,
            'route'  => $route,
            'icon' => $icon
        ]);
    }
    public function editFile($id)
    {

        $action = 'Editar';
        $route = "investor.file.send.edit";
        $icon = "fas fa-plus";
        $data = File::find($id);

        return view('dashboard.investor.file.form', [
            'data'   => $data,
            'action' => $action,
            'route'  => $route,
            'icon' => $icon
        ]);
    }
    public function deleteFile($id)
    {
        $file = new File;
        $data = $file->fileDel($id);
        return $data;
    }

    public function shoreFile(Request $request)
    {
        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }
        if (!empty($request->file('file'))) {

            $validator = Validator::make($request->all(), [
                'file' => 'mimes: doc,docx,xlsx,xls,pdf'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $nameFile = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->file->extension();

            // Define finalmente o nome
            $path = "{$name}.{$extension}";
            $type = $extension;


            $input = [
                'name' => $request->name,
                'year' => $request->year,
                'status' => $status,
                'path' => $path,
                'type' => $type,
                'month' => $request->month,
                'password' => $request->password
            ];
        }
        $input = [
            'name' => $request->name,
            'year' => $request->year,
            'status' => $status,
            'month' => $request->month,
            'password' => $request->password
        ];
        $file = new File;

        $data = $file->fileAdd($input);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            // Faz o upload:
            $upload = $request->file->storeAs('investor/plan/', $path, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();

            if (!empty($data->id)) {
                return \Redirect::route('investor.file.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('investor.file.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        } else {
            if (!empty($data->id)) {
                return \Redirect::route('investor.file.add')->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('investor.file.add')->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        }
    }
    public function updateFile(Request $request)
    {
        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        if (!empty($request->file('file'))) {
            $validator = Validator::make($request->all(), [
                'file' => 'mimes: doc,docx,xlsx,xls,pdf'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $nameFile = null;

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->file->extension();

            // Define finalmente o nome
            $path = "{$name}.{$extension}";
            $type = $extension;

            $input = [
                'name' => $request->name,
                'year' => $request->year,
                'status' => $status,
                'path' => $path,
                'type' => $type,
                'month' => $request->month,
                'password' => $request->password
            ];
        } else {

            $input = [
                'name' => $request->name,
                'year' => $request->year,
                'status' => $status,
                'month' => $request->month,
                'password' => $request->password
            ];
        }
        $file = new File;



        $file = File::find($request->id);

        if ($request->password != $file->password && $file->status == 1) {
            $users = User::where('role', 2)->where('status', 1)->get();
            $email = Paramenter_Email::where('id', 7)->where('status', 1)->first();
            $input2 = array();


            //  dd('acesso');

            /*   foreach ($users as $user) {
                $input2 = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'content_email' => $email->content,
                    'password'   => $request->password,
                    'nomearquivo'   => $file->name,
                    'year'   => $file->year,
                    'month'   => $file->month
                ];
                Mail::send(new \App\Mail\investorPasswordFileSend($input2));
                sleep(5);
            } */

            $input2 = [
                'content_email' => $email->content,
                'password'   => $request->password,
                'nomearquivo'   => $file->name,
                'year'   => $file->year,
                'month'   => $file->month
            ];
            //  dd('acesso');

            Mail::send('mail.investorpasswordfilesend', ['input2' => $input2, "users" => $users], function ($email) use ($input2, $users) {
                $email->from('noreply@usinasonora-ms.com.br', 'Usina Sonora MS - Não Responda');
                $email->subject("Alteração de senha de acesso ao arquivo do investidor");
                foreach ($users as $user) {
                    $email->to('noreply@usinasonora-ms.com.br', 'Não Responda');
                    $email->cc($user->email, $user->name);
                }
            });
        }

        $data = $file->fileEdit($input, $request->id);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $old = 'investor/plan/' . $request->fileOld;
            \Storage::disk('public')->delete($old);
            // Faz o upload:
            $upload = $request->file->storeAs('investor/plan', $path, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload)
                return \Redirect()
                    ->back()
                    ->with(['icon' => 'error', 'message' => 'error', 'Falha ao fazer upload'])
                    ->withInput();

            if (!empty($data->id)) {

                return \Redirect::route('investor.file.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('investor.file.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        } else {
            if (!empty($data->id)) {
                return \Redirect::route('investor.file.edit', ['id' => $request->id])->with(['icon' => 'success', 'message' => 'Dados Salvo']);
            } else {
                return \Redirect::route('investor.file.edit', ['id' => $request->id])->with(['icon' => 'error', 'message' => 'Erro ao salvar']);
            }
        }
    }
}
