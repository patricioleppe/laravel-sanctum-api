<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \stdClass;
use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request-> all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:8'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;        

        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer', ]);

           
    }

    public function login(Request $request){
        /* Checking if the user is authenticated. */
        if (!Auth::attempt($request->only('email','password'))){
            return response()->json(['message'=> 'Unauthorized'], 401);
        }

        /* Getting the user from the database. */
        /* firstOrFail() A method that returns the first record of the database. */
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hola! '.$user->name,
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user'=> $user,
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return [
            'message'=>"Fuiste deslogeado!, y tu token eliminado."
        ];
    }
    
}
