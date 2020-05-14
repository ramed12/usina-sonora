<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Paramenter_Lgpd extends Model
{
    public function paramenterLGPDAdd($input)
    {
        $paramenter = new Paramenter_Lgpd;

        if(!empty($input['name']))
            $paramenter->name = $input['name'];
        if(!empty($input['content']))
            $paramenter->content = $input['content'];
        if(!empty($input['status']))
            $paramenter->status = $input['status'];

        $paramenter->save();
        return $paramenter;
    }
    public function paramenterLGPDEdit($input,$id)
    {
        $paramenter = Paramenter_Lgpd::find($id);

        if(!empty($input['name']))
            $paramenter->name = $input['name'];
        if(!empty($input['content']))
            $paramenter->content = $input['content'];
        if(!empty($input['status']))
            $paramenter->status = $input['status'];

        $paramenter->save();
        return $paramenter;
    }
    public function paramenterLGPDDel($id)
    {
        $data = Paramenter_Lgpd::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
