<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\models\Role');
    }
    public function hasAnyRole($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function userAdd($input)
    {

        $user = new User;

        if (!empty($input['name']))
            $user->name = $input['name'];
        if (!empty($input['email']))
            $user->email = $input['email'];
        if (!empty($input['phone']))
            $user->phone = $input['phone'];
        if (!empty($input['password']))
            $user->password = Hash::make($input['password']);
        if (!empty($input['status']))
            $user->status = $input['status'];
        if (!empty($input['role']))
            $user->role = $input['role'];

        $user->save();

        return $user;
    }

    public function userEdit($input, $id)
    {
        $user = User::find($id);

        if (!empty($input['name']))
            $user->name = $input['name'];
        if (!empty($input['email']))
            $user->email = $input['email'];
        if (!empty($input['phone']))
            $user->phone = $input['phone'];
        if (!empty($input['password']))
            $user->password = Hash::make($input['password']);
        if (!empty($input['status']))
            $user->status = $input['status'];
        if (!empty($input['role']))
            $user->role = $input['role'];

        $user->save();

        return $user;
    }

    public function userDel($id)
    {
        $data = User::where('id', $id)->update([
            'status'    => 0
        ]);
        return $data;
    }
}
