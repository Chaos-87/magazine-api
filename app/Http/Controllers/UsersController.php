<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $userData = $request->only('name', 'password');

        if(!$token = auth()->attempt($userData)) {
            return response()->json([
                'error' => 'Incorrect name or password'
            ], 401);
        }

        return response()->json(['token' => $token]);
    }
}
