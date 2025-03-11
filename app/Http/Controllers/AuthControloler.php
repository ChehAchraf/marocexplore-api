<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AuthControloler extends Controller
{
    public function register(Request $request){
        // get the data and do the validation 😁
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users|email',
            'password'  => 'confirmed'
        ]);
        // create the user
        $userCreation = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = $userCreation->createToken('apptoken')->plainTextToken;
        // return the result
        if($userCreation){
            return response()->json([
                'message'   =>  'user created succufully !',
                'token'     =>  $token
            ], 200);
        }else{
            return response()->json(['message'=>'Failed to create user'],500);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json(['token' => $user->createToken('auth_token')->plainTextToken]);
    }
}
