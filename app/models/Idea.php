<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    public function add($input)
    {

        $data = new Idea;

        if(!empty($input['name']))
            $data->name = $input['name'];
        if(!empty($input['departament']))
            $data->departament = $input['departament'];
        if(!empty($input['subject']))
            $data->subject = $input['subject'];
        if(!empty($input['content']))
            $data->content = $input['content'];

            $data->status = 1;

        $data->save();

        return $data;
    }

    public function del($id)
    {
        $data = Idea::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
