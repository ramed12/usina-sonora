<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Contact;
use App\User;
use App\models\Idea;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = User::where('role', 2)->where('status', 1)->get();
        $contact = Contact::where('status', 1)->get();
        $idea = Idea::where('status', 1)->get();

        return view('dashboard.home', ['user' => $user, 'contact' => $contact, 'idea' => $idea]);
    }
}
