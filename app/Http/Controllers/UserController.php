<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }    

    public function signup(Request $request) 
    {
        $data = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed',
            'email' => 'required|email:rfc|unique:users,email',
            'phone' => 'required|numeric',
            'country' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|numeric',
            'name' => 'required|string',
            'address' => 'required|string'
        ]);

        $user = User::create([
                    'username' => $data['username'],
                    'password' => bcrypt($data['password']),
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'country' => $data['country'],
                    'city' => $data['city'],
                    'postcode' => $data['postcode'],
                    'name' => $data['name'],
                    'address' => $data['address']
                ]);

        $token = $user->createToken('mytoken')->plainTextToken;
        
        $response = [
            'email' => $user['email'],
            'token' => $token,
            'username' => $user['username']
        ];

        return response()->json($response, 200);
    }

    public function signin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email:rfc',
            'password' => 'required|string'
        ]);

        // Get user
        $user = User::where('email', $data['email'])->first();

        // Check user
        if ($user) {
            // Check password
            if (!Hash::check($data['password'], $user->password)) {
                return response()->json([
                    'message' => 'Wrong password.'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Unregistered.'
            ], 404);
        }

        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'email' => $user['email'],
            'token' => $token,
            'username' => $user['username']
        ];

        return response()->json($response, 200);
    }
}
