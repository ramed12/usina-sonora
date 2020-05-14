<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\LogInvestor;
use Illuminate\Http\Request;

class LogInvestorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data  = LogInvestor::all();

        return view('dashboard.log.list', ['data' => $data]);
    }
}
