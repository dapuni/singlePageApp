<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\roles;
use Validator;

class UsersController extends Controller
{

    public function index()
    {
        $data['users'] = user::paginate(5);
        $data['roles'] = roles::all();
        return view('users.users',$data);
    }

    public function save(Request $request) {
        $validation = Validator::make($request->all(), [
                               'name' => 'required',
                               'password' => 'required',
                               'role' => 'required',
                            ]);

        if( $validation->fails()){
            return response()->json([
                    'errors' => $validation->errors()->getMessages(),
                    'code' => 422
                 ]);
        };

        if ($request->input('id') == '') {
            User::insertData($request);
            $status = 'Insert OK';
        } else {
            User::updateData($request);
            $status = 'Update OK';
        }

        return response()->json([
            'status' => $status
        ]);
    }

    public function edit($id)
    {
        return User::find($id);
    }

    public function delete($id)
    {
        User::deleteData($id);
        return response()->json([
            'status' => 'Data dihapus',
        ]);
    }
}
