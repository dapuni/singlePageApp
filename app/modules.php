<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modules extends Model
{
    protected $fillable = ['module','parent'];

    public static function insertData($request) {
    	$module = new modules();
    	$module->module = $request->input('module');
    	$module->parent = $request->input('parent');
    	$module->save();
    }

    public static function updateData($request) {
    	$module = modules::find($request->input('id'));
    	$module->module = $request->input('module');
    	$module->parent = $request->input('parent');
    	$module->save();
    }

    public static function deleteData($id) {
    	$module = modules::find($id);
    	$module->delete();
    }
}
