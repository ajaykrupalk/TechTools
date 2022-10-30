<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // Logs in a user
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return response(Auth::user(), 200);
        }

        abort(401);
    }
    
    // Creates a new user
    public function register(Request $request){
        
        $fields = $request->validate([
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
              
        return response($response, 201);
    }

       
    // Shows a list of all the users
    public function show(){
        $users = User::all();
        return $users;
    }

    // Shows a specific user
    // Using it for login functionality
    // where it shows register or login form based on
    // if the user is already registered or not
    public function find($email){
        $user = User::where('email', $email)->first();
        return $user;
    }

    public function logout(){
        Auth::logout();
        return response('Logged out', 200);
    }
}
