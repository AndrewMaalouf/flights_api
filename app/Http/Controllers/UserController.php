<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::get();

        return response()->json($users);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:passengers',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json($user, 201); 
    }

    public function show($id){
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
        ]);
    
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
    
        $user = User::findOrFail($id);
        $user->update($validatedData);
    
        return response()->json($user);
    }

    public function destroy($id){

        $user = User::findOrFail($$id);

        $user->delete();
        return response()->json(null, 204);
    }
}
