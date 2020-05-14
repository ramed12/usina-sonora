<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    public function menu()
	{
		return $this->belongsTo('App\Models\Menu');
	}

  public function subMenuAdd($input)
    {
        $data = new SubMenu;
        
        $status = 0; 

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
            } 
            $data->status = $status;
        }
        if(!empty($input['image']))
            $data->image = $input['image'];

        if(!empty($input['file']))
            $data->file = $input['file'];

        if(!empty($input['tag']))
            $data->tag = $input['tag'];
        
        if(!empty($input['position']))
            $data->position = $input['position'];

        $data->save();
        return $data;
    }

    public function updateSubMenu($input,$id)
    {

        $data = SubMenu::find($id);



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

        if(!empty($input['tag']))
            $data->tag = $input['tag'];
            
        if(!empty($input['position']))
            $data->position = $input['position'];

        return  $data->save();
    }

    public function subMenuDel($id)
    {
        $data = SubMenu::where('id',$id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
