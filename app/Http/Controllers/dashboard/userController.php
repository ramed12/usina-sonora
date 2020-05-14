<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {

        $data = User::where('role',1)->get();
        return view('dashboard.user.list',['data'=>$data]);

    }

    public function add()
    {
        $action = 'Criar';
        $route = "user.send.add";
        $icon = "fas fa-plus";
        $role = 1;

        return view('dashboard.user.form',['data'   =>[],
                                           'action' => $action,
                                           'route'  => $route,
                                           'icon' => $icon,
                                           'role' => $role
                    ]);
    }

    public function edit($id)
    {

        $action = 'Editar';
        $route = "user.send.edit";
        $icon = "fas fa-plus";
        $data = User::find($id);

        return view('dashboard.user.form',['data'   =>$data,
                                           'action' => $action,
                                           'route'  => $route,
                                           'icon' => $icon
                    ]);

    }

    public function store(Request $request)
    {

        $user = new User;

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

	$email = User::where('email',$request->email)->first();

	if(!empty($email)){
	
	return \Redirect::route('user.add')->with(['icon' => 'error','message' => 'E-mail já cadastrado']);
	exit;

	}

        $input = [
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => $request->password,
            'status'     => $status,
            'role'       => $request->role,
        ];

 /*        $validator = $input->validate([
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



        $data = $user->userAdd($input);

        $data->roles()->sync(1);

        if(!empty($data->id))
        {
            return \Redirect::route('user.add')->with(['icon' => 'success','message' => 'Dados Salvo']);
        }else{
            return \Redirect::route('user.add')->with(['icon' => 'error','message' => 'Erro ao salvar']);
        }

    }

    public function update(Request $request)
    {

        if($request->status == 'on'){
            $status = 1;
        }else{
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

/*         $validator = $input->validate([
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'password'  => 'required',
            'status'    => 'required'
        ]);

        if(empty($validator))
        {
            return $request->input();
        }
 */
        $user = new User;

        $data = $user->userEdit($input,$request->id);
        if(!empty($data->id))
        {
            return \Redirect::route('user.edit',['id' => $request->id])->with(['icon' => 'success','message' => 'Dados Salvo']);
        }else{
            return \Redirect::route('user.edit',['id' => $request->id])->with(['icon' => 'error','message' => 'Erro ao salvar']);
        }


    }

    public function delete($id)
    {
        $new = new User;
        $data = $new->userDel($id);
        return $data;
    }
}
