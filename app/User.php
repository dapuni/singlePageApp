<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function insertData($request) {
        $module = new User();
        $module->name = $request->input('name');
        $module->email = $request->input('email');
        $module->password = bcrypt($request->input('password'));  
        $module->role_id = $request->input('role');
        $module->save();
    }

    public static function updateData($request) {
        $module = User::find($request->input('id'));
        $module->name = $request->input('name');
        $module->email = $request->input('email');
        $module->password = bcrypt($request->input('password'));  
        $module->role_id = $request->input('role');
        $module->save();
    }

    public static function deleteData($id) {
        $module = User::find($id);
        $module->delete();
    }
}
