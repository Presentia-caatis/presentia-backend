<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {

        $request->authenticate();

        $user = $request->user();

        // Update the current session ID
        $user->update(['current_session_id' => session()->getId()]);

        $user->tokens()->delete();
        $token = $user->createToken('api-token');

        return response()->json([
            "user" => $user,
            "token" => $token->plainTextToken,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
