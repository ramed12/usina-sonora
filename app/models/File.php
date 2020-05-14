<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function fileAdd($input)
    {
        $file = new File;

        if (!empty($input['name']))
            $file->name = $input['name'];
        if (!empty($input['year']))
            $file->year = $input['year'];
        if (!empty($input['month']))
            $file->month = $input['month'];
        if (!empty($input['path']))
            $file->path = $input['path'];
        if (!empty($input['status']))
            $file->status = $input['status'];
        if (!empty($input['type']))
            $file->type = $input['type'];
        if (!empty($input['password']))
            $file->password = $input['password'];

        $file->save();

        return $file;
    }

    public function fileEdit($input, $id)
    {
        $file = File::find($id);

        if (!empty($input['name']))
            $file->name = $input['name'];
        if (!empty($input['year']))
            $file->year = $input['year'];
        if (!empty($input['month']))
            $file->month = $input['month'];
        if (!empty($input['path']))
            $file->path = $input['path'];
        if (!empty($input['status']))
            $file->status = $input['status'];
        if (!empty($input['password']))
            $file->password = $input['password'];

        $file->save();

        return $file;
    }


    public function fileDel($id)
    {
        $data = File::where('id', $id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
