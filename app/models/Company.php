<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function companyEdit($request)
    {
            $company = Company::find($request->id);

            if(!empty($request->name))
                $company->name = $request->name;
            if(!empty($request->phone))
                $company->phone = $request->phone;
            if(!empty($request->fax))
                $company->fax = $request->fax;
            if(!empty($request->whatsapp))
                $company->whatsapp = $request->whatsapp;
            if(!empty($request->address))
                $company->address = $request->address;
            if(!empty($request->maps))
               $company->maps = $request->maps;
            if(!empty($request->facebook))
               $company->facebook = $request->facebook;
            if(!empty($request->linkedin))
               $company->linkedin = $request->linkedin;
            if(!empty($request->instagram))
               $company->instagram = $request->instagram;
            if(!empty($request->googleplus))
               $company->googleplus = $request->googleplus;

            $company->save();

            return $company;

    }
}
