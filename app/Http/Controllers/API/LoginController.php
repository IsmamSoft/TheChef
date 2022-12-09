<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginCOntroller extends Controller
{
    function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // $user = Auth::user();
            $user = $request->user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name']  = $user->name;
            $response = [
                'success' => true,
                'data'    => $success,
                'message' => "User register Successfully"
            ];
            return response()->json($response, 200);
        }
    }

    function register(Request $request)
    {
        // Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'  => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name']  = $user->name;

        $response = [
            'success' => true,
            'data'    => $success,
            'message' => "User register Successfully"
        ];

        return response()->json($response, 200);
    }

}
