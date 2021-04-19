<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{

    public function register(Request $request){
        $dataValidated=$request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $dataValidated['password']=Hash::make($request->password);

        $user = User::create($dataValidated);

        $token = $user->createToken('Tt')->accessToken;

        return response()->json(['token' => $token], 200);

    }

    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $user=Auth::user();
            $success['token']=$user->createToken('Tt')->accessToken;
            $success['user']=$user->email;
            return $this->sendResponse($success,'Login sucessful');

        }
        else{
            return $this->sendError('Unathorized',['error'=>'Unauthorized']);
        }
    }
    public function users(Request $request){

    }

    public function update(Request $request, $id){
        $user=User::find($id);

        $validator = Validator::make($request->all(),
        [
            'name' => 'unique:users|max:100',
            'email' => 'unique:users|email|max:255',
        ]);

       if($validator->fails()){
        return $this->sendError('Bad data');
       }

        if($user){
            $user->update($request->all());
            return $this->sendResponse($user,"User updated");
        }else{
            return $this->sendError('User not found');
        }

    }
}
