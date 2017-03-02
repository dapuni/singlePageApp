<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modules;
use App\roles;
use Validator;

class RolesController extends Controller
{
    public function index()
    {
    	
    	$data['modules'] = modules::All();
    	$data['roles'] = roles::paginate(5);
    	return view('roles.roles',$data);
    }

    public function save(Request $request)
    {
    	$validation = Validator::make($request->all(), [
                               'role' => 'required',
	        				   'module' => 'required',
                            ]);

		if( $validation->fails()){
		    return response()->json([
		            'errors' => $validation->errors()->getMessages(),
		            'code' => 422
		        ]);
		};

		if ($request->input('id') == '') {
			roles::insertData($request);
			$status = 'Insert OK';
		} else {
			roles::updateData($request);
			$status = 'Update OK';
		}
    	
    	return response()->json([
    		'status' => $status,
    	]);
    }

    public function edit($id)
    {
    	return roles::find($id);
    }

    public function delete($id)
    {
    	roles::deleteData($id);
    	return response()->json([
    		'status' => 'Data dihapus',
    	]);
    }
}
