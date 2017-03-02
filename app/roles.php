<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
	protected $fillable = ['role','module'];

    public static function insertData($request) {
    	$module = new roles();
    	$module->role = $request->input('role');
    	$module->module = implode(',', $request->input('module'));
    	$module->save();
    }

    public static function updateData($request) {
    	$module = roles::find($request->input('id'));
    	$module->role = $request->input('role');
    	$module->module = implode(',', $request->input('module'));
    	$module->save();
    }

    public static function deleteData($id) {
        $module = roles::find($id);
        $module->delete();
    }
}
