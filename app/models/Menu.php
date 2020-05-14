<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function submenus()
	{
		return $this->hasMany('App\Models\Submenu');
	}

    public function updateMenu($input,$id)
    {

        $data = Menu::find($id);


        if(!empty($input['name']))
            $data->name = $input['name'];
        if(!empty($input['url']))
            $data->url = $input['url'];
        if(!empty($input['icon']))
            $data->icon = $input['icon'];
        if(!empty($input['menu_id']))
            $data->menu_id = $input['menu_id'];
        if(!empty($input['content']))
            $data->content = $input['content'];
        if(!empty($input['status'])){
            if($input['status'] == 'on'){
                $status = 1;
            }else{
                $status = 0;
            }
            $data->status = $status;
        }
        if(!empty($input['image']))
            $data->image = $input['image'];

        if(!empty($input['file']))
            $data->file = $input['file'];

        return  $data->save();
    }

    public function menuDel($id)
    {
        $data = Menu::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
