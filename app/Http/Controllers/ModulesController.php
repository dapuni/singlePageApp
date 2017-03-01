<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modules;
use Validator;

class ModulesController extends Controller
{
    public function index()
    {
    	$data['allModule'] = modules::where('parent',0)->get();
    	$data['modules'] = modules::paginate(5);
    	return view('modules.modules',$data);
    }

    public function save(Request $request) {
    	$validation = Validator::make($request->all(), [
                               'module' => 'required',
	        				   'parent' => 'required',
                            ]);

		if( $validation->fails()){
		    return response()->json([
		            'errors' => $validation->errors()->getMessages(),
		            'code' => 422
		         ]);
		};

		if ($request->input('id') == '') {
			modules::insertData($request);
			$status = 'Insert OK';
		} else {
			modules::updateData($request);
			$status = 'Update OK';
		}
    	
    	$data = modules::where('parent','0')->get();
    	return response()->json([
    		'data' => $data,
    		'status' => $status
    	]);
    }

    public function edit($id)
    {
    	return modules::find($id);
    }

    public function delete($id)
    {
    	modules::deleteData($id);
    	return response()->json([
    		'status' => 'Data dihapus',
    	]);
    }
}
