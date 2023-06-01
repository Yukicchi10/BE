<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedController extends BaseController
{

    public function username()
    {
        return 'email';
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = Mahasiswa::where('email', $request->email)->first();
            if (!$user) {
                return $this->sendError('username', $this->username() . ' not found', 401);
            }
            if (!Auth::attempt($request->only($this->username(), 'password'), $request->remember_me)) {
                return $this->sendError('password', 'Wrong Password', 401);
            }

            $token = $user->createToken('token')->plainTextToken;
            $dataUser = [
                'id' => $user->idMahasiswa,
                'name' => $user->nama,
                'email' => $user->email,
                'token' => $token
            ];

            $response = [
                'user' => $dataUser
            ];

            return $this->sendResponse($response, 'User login successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Handle logout request.
     */
    public function destroy()
    {
        Auth::guard('web')->logout();
        $user = request()->user();
        $user->tokens()->delete();

        return $this->sendResponse([], 'User logout successfully.');
    }

    //

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];
        

        if (!$token = Auth::attempt($infologin)) {
            return response()->json(['error' => 'Username dan password tidak sesuai'], 401);
        }
        
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'role'=> Auth::user()->role
            // 'expires_in' => auth()->factory()->getTTL() * 120
        ]);
    }
}
