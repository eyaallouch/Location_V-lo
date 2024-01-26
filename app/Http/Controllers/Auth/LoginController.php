<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
     public function login(Request $request)
          {
             $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
          if (Auth::attempt($request->only('email', 'password'))) {
                 $user = Auth::user();
                 $token = $user->createToken('token-name')->plainTextToken;
               //  $client;
                   return response()->json([
                      'status' => true,
                      'message' => 'User Logged In Successfully',
                      'token' => $token,
                      'user' =>$user
                    //  'client' =>$client
                    ], 200);
            }
            throw ValidationException::withMessages([
             'email' => ['The provided credentials are incorrect.'],
            ]);
          }
      public function logout(Request $request)
       {
          $request->user()->tokens()->delete();
          return response()->json([
              'message' => 'Successfully logged out'
           ]);

        }

}