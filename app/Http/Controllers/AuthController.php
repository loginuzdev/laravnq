<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function authenticate(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'username' => ['required', "string"],
                'password' => ['required', "string"],
            ]);
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json([
                    "ok" => true,
                    "data" => Auth::user(),
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                "ok" => false,
                "data" => null,
                "error" => $exception->getMessage(),
            ]);
        }


        return response()->json([
            "ok" => false,
            "data" => null,
            "error" => "Username or password is incorrect",
        ]);
    }
}
