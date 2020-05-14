<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Paramenter_Email extends Model
{
    public function paramenterEmailAdd($input)
    {
        $paramenter = new Paramenter_Email;

        if(!empty($input['name']))
            $paramenter->name = $input['name'];
        if(!empty($input['content']))
            $paramenter->content = $input['content'];
        if(!empty($input['status']))
            $paramenter->status = $input['status'];

        $paramenter->save();
        return $paramenter;
    }
    public function paramenterEmailEdit($input,$id)
    {
        $paramenter = Paramenter_Email::find($id);

        if(!empty($input['name']))
            $paramenter->name = $input['name'];
        if(!empty($input['content']))
            $paramenter->content = $input['content'];
        if(!empty($input['status']))
            $paramenter->status = $input['status'];

        $paramenter->save();
        return $paramenter;
    }
    public function paramenterEmailDel($id)
    {
        $data = Paramenter_Email::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
