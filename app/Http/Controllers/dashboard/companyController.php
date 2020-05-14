<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Company;

class companyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Company::all();

        return view('dashboard.company.form', ['data' => $data]);
    }

    public function update(Request $request)
    {

        $company = new Company;

        $data = $company->companyEdit($request);

        return $data;
    }
}
