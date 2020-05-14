<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    public function imageAdd($input)
    {
        $image = new Images;

        if(!empty($input['name']))
            $image->name = $input['name'];
        if(!empty($input['type']))
            $image->type = $input['type'];
        if(!empty($input['gallery']))
            $image->gallery = $input['gallery'];
        if(!empty($input['position']))
            $image->position = $input['position'];
        if(!empty($input['path']))
            $image->path = $input['path'];
        if(!empty($input['status']))
            $image->status = $input['status'];
        if(!empty($input['description']))
            $image->description = $input['description'];
        if(!empty($input['category']))
            $image->category = $input['category'];        
	if(!empty($input['poster']))
            $image->poster= $input['poster'];


            $image->save();
            return $image;

    }

    public function imageEdit($input,$id)
    {
        $image = Images::find($id);

        if(!empty($input['name']))
            $image->name = $input['name'];
        if(!empty($input['type']))
            $image->type = $input['type'];
        if(!empty($input['gallery']))
            $image->gallery = $input['gallery'];
        if(!empty($input['position']))
            $image->position = $input['position'];
        if(!empty($input['path']))
            $image->path = $input['path'];
        if(!empty($input['status']))
            $image->status = $input['status'];
        if(!empty($input['description']))
            $image->description = $input['description'];
        if(!empty($input['category']))
            $image->category = $input['category'];
	if(!empty($input['poster']))
            $image->poster= $input['poster'];


            $image->save();
            return $image;

    }

    public function imagesDel($id)
    {
        $data = Images::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
