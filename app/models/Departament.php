<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    public function departamentAdd($input)
    {
        $departament = new Departament;

        if(!empty($input['name']))
            $departament->name = $input['name'];
        if(!empty($input['email']))
            $departament->email = $input['email'];
        if(!empty($input['status']))
            $departament->status = $input['status'];

        $departament->save();
        return $departament;
    }

    public function departamentEdit($input,$id)
    {
        $departament = Departament::find($id);
        if(!empty($input['name']))
            $departament->name = $input['name'];
        if(!empty($input['email']))
            $departament->email = $input['email'];
        if(!empty($input['status']))
            $departament->status = $input['status'];

        $departament->save();
        return $departament;
    }

    public function departamentDel($id)
    {
        $data = Departament::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
