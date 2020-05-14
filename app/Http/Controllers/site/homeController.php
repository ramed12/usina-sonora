<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\News;
use App\models\Departament;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\models\Contact;
use App\models\Paramenter_Email;
use Illuminate\Support\Facades\Mail;
use App\Models\Images;
use App\models\Paramenter_Lgpd;
use App\models\Idea;
use Illuminate\Support\Facades\Http;

class homeController extends Controller
{
    public function index()
    {
        $certificates = Images::where('gallery', 'certificate')->where('status', 1)->orderBy('position', 'asc')->get();
        $news = News::where('status', 1)->where('image', '!=', '')->limit(5)->orderBy('date', 'desc')->orderBy('date', 'desc')->get();
        return view('site.index', ['news' => $news, 'certificates' => $certificates]);
    }
    public function investor()
    {
        return view('site.investor');
    }

    public function privacyPolitc()
    {

        $lgpd = Paramenter_Lgpd::where('status', 1)->first();
        return view('site.lgpd', ['lgpd' => $lgpd]);
    }
    public function contact()
    {
        $departament = Departament::all();
        return view('site.contact', ['departament' => $departament]);
    }
    public function contactSend(Request $request)
    {
        $contact = new Contact;

        $validate = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'departament' => $request->departament,
            'subject' => $request->subject,
            'message' => $request->content
        ];
        $validation = Validator::make($validate, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if ($validation->fails()) {
            return \Redirect()->route('site.investor')->withErrors($validation)->withInput();
            return false;
        }
        $email = Paramenter_Email::where('id', 3)->where('status', 1)->first();
        $email2 = Paramenter_Email::where('id', 4)->where('status', 1)->first();
        $departament = Departament::where('id', $request->departament)->where('status', 1)->first();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->content,
            'content_email' => $email->content,
            'departament' => $departament->name,
            'phone' => $request->phone,
            'subject' => $request->subject
        ];
        $data2 = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->content,
            'content_email' => $email2->content,
            'departament' => $departament->name,
            'departament_email' => $departament->email,
            'departament_name' => $departament->name,
            'subject' => $request->subject
        ];



        $result = $contact->contactInsert($validate);


        if (!empty($result)) {
            Mail::send(new \App\Mail\ContactSender($data));
            Mail::send(new \App\Mail\ContactDepartamentSender($data2));
            return \Redirect::route('site.contact')->with(['icon' => 'success', 'message' => 'Cadastrado com sucesso']);
        } else {
            return \Redirect::route('site.contact')->with(['icon' => 'error', 'message' => 'Erro ao cadastrar']);
        }
    }
    public function investorSend(Request $request)
    {
        $user = new User;

        $validate = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'enterprise' => $request->company,
            'relationship' => $request->relationship,
            'status' => 0,
            'role' => 2
        ];

        $find = $user::where('email', $request->email)->first();
        if (!empty($find)) {
            return \Redirect()->route('site.investor')->withInput();
        } else {

            $validation = Validator::make($validate, [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required'
            ]);

            if ($validation->fails()) {
                return \Redirect()->route('site.investor')->withErrors($validation)->withInput();
                return false;
            }

            $investor = $user->userAdd($validate);
            $investor->roles()->sync(2);


            if (!empty($investor->id)) {
                return \Redirect::route('site.investor')->with(['icon' => 'success', 'message' => 'Cadastrado com sucesso']);
            } else {
                return \Redirect::route('site.investor')->with(['icon' => 'error', 'message' => 'Erro ao cadastrar']);
            }
        }
    }

    public function work()
    {
        //Pega as vagas
        $response = Http::get('http://portalrm.usinasonora-ms.com.br:8080/rm/api/RhuVagasServerREST/GetVagasDestaque');
        $vagas = [];

        if ($response->successful()) {
            $vagas = $response->json()['data'];
        }



        return view('site.trabalhe', ['vagas' => $vagas]);
    }
    public function email()
    {

        $email = Paramenter_Email::where('id', 5)->where('status', 1)->first();
        $data = [
            'name' => 'Flávio Massao Moraes Hayashida',
            'phone' => '(65) 99947-8142',
            'email' => 'fmmh18@gmail.com',
            'departament' => 'TI',
            'departament_email' => 'ti@ti.com.br',
            'message' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'content_email' => $email->content,
            'subject' => 'Idéia'
        ];

        //return  Mail::send(new \App\Mail\ContactDepartamentSender($data));
        return new \App\Mail\ideaSender($data);
    }

    public function videoList(Request $request)
    {
        $data = Images::whereIn('type', array('mp4', 'youtube'))->where('gallery', 'video')->where('status', 1);

        if ($request->input('category')) {
            $data->where('category', $request->input('category'));
        }

        return view('site.video.index', [
            'data' => $data->paginate(15)
        ]);
    }

    public function videoDetail($id)
    {

        $data = Images::where('id', $id)->where('status', 1)->first();
        return view('site.video.detail', [
            'data' => $data
        ]);
    }

    public function idea()
    {
        $departament = Departament::where('status', 1)->get();
        return view('site.idea', ['departament' => $departament]);
    }

    public function ideaSend(Request $request)
    {
        $validate = [
            'name' => $request->name,
            'subject' => $request->subject,
            'departament' => $request->departament,
            'content' => $request->content,
        ];

        $validation = Validator::make($validate, [
            'content' => 'required',
            'departament' => 'required'
        ]);

        if ($validation->fails()) {
            return \Redirect()->route('site.idea')->withErrors($validation)->withInput();
            return false;
        }
        $idea = new Idea;
        $result = $idea->add($validate);


        if (!empty($result->id)) {
            $email = Paramenter_Email::where('id', 5)->where('status', 1)->first();
            $departament = Departament::where('id', $request->departament)->where('status', 1)->first();
            if (!empty($request->name)) {
                $name = $request->name;
            } else {
                $name = 'Anônimo';
            }
            $data = [
                'name' => $name,
                'departament' => $departament->name,
                'message' => $request->content,
                'content_email' => $email->content,
                'subject' => $request->subject
            ];
            Mail::send(new \App\Mail\ideaSender($data));
            return \Redirect::route('site.idea')->with(['icon' => 'success', 'message' => 'Cadastrado com sucesso']);
        } else {
            return \Redirect::route('site.idea')->with(['icon' => 'error', 'message' => 'Erro ao cadastrar']);
        }
    }


    public function lgpd($slug)
    {

        $lgpd = Paramenter_Lgpd::where('slug', $slug)->first();
        return view('site.lgpd', ['lgpd' => $lgpd]);
    }
}
