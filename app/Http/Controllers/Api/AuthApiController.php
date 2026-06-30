<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthApiController extends Controller
{
    // ─── Login & Dapatkan Token ───────────────────────────────────────────────

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah.',
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat token. Silakan coba lagi.',
            ], 500);
        }

        return $this->respondWithToken($token);
    }

    // ─── Register & Dapatkan Token ────────────────────────────────────────────

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'unique:users,email'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'user',
            'is_active' => true,
        ]);

        $token = auth('api')->login($user);

        return $this->respondWithToken($token, 201);
    }

    // ─── Refresh Token ────────────────────────────────────────────────────────

    public function refresh(): JsonResponse
    {
        try {
            $newToken = auth('api')->refresh();
            return $this->respondWithToken($newToken);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid atau sudah kadaluarsa.',
            ], 401);
        }
    }

    // ─── Logout (Invalidate Token) ────────────────────────────────────────────

    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil logout. Token telah dinonaktifkan.',
        ]);
    }

    // ─── Info User Yang Sedang Login ──────────────────────────────────────────

    public function me(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => auth('api')->user(),
        ]);
    }

    // ─── Helper: Format Response Token ───────────────────────────────────────

    private function respondWithToken(string $token, int $status = 200): JsonResponse
    {
        return response()->json([
            'success'      => true,
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'user'         => auth('api')->user(),
        ], $status);
    }
}
