<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{

    public function newsAdd($input)
    {
        $new = new News;

        if(!empty($input['title']))
            $new->title = $input['title'];
        if(!empty($input['subtitle']))
            $new->subtitle = $input['subtitle'];
        if(!empty($input['content']))
            $new->content = $input['content'];
        if(!empty($input['author']))
            $new->author = $input['author'];
        if(!empty($input['slug']))
            $new->slug = $input['slug'];
        if(!empty($input['url_site']))
            $new->url_site = $input['url_site'];
        if(!empty($input['status']))
            $new->status = $input['status'];
        if(!empty($input['imageNew']))
            $new->image = $input['imageNew'];
        if(!empty($input['date']))
            $new->date = $input['date'];

        $new->save();
        return $new;
    }

    public function newsEdit($input,$id)
    {
        $new = News::find($id);

        if(!empty($input['title']))
            $new->title = $input['title'];
        if(!empty($input['subtitle']))
            $new->subtitle = $input['subtitle'];
        if(!empty($input['content']))
            $new->content = $input['content'];
        if(!empty($input['author']))
            $new->author = $input['author'];
        if(!empty($input['slug']))
            $new->slug = $input['slug'];
        if(!empty($input['url_site']))
            $new->url_site = $input['url_site'];
        if(!empty($input['status']))
            $new->status = $input['status'];
        if(!empty($input['imageNew']))
            $new->image = $input['imageNew'];
        if(!empty($input['date']))
            $new->date = $input['date'];

        $new->save();
        return $new;
    }

    public function newsDel($id)
    {
        $data = News::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
