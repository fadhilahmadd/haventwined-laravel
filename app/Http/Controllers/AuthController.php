<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a new user and return a standardized JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Generate an API token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return a JSON response without wrapping the token in a "data" key
        return response()->json([
            'success' => true,
            'token'   => $token,
            'message' => 'User registered successfully.'
        ], 201);
    }

    /**
     * Log in an existing user and return a standardized JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the credentials
        $credentials = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.'
            ], 401);
        }

        // Retrieve the authenticated user and generate a token
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return a JSON response with token and message
        return response()->json([
            'success' => true,
            'token'   => $token,
            'message' => 'User logged in successfully.'
        ], 200);
    }

    /**
     * Log out the authenticated user by revoking the current access token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke the current access token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'User logged out successfully.'
        ], 200);
    }
}
