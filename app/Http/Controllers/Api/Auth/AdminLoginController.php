<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\TokenRepository;

class AdminLoginController extends Controller
{
    /**
     * Admin Register.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        Admin::create([
            'name' => $validator->validated()['name'],
            'email' => $validator->validated()['email'],
            'password' => bcrypt($validator->validated()['password'])
        ]);

        return Response()->json([
            'message' => 'Registrado com sucesso.'
        ], 200);
    }
    /**
     * Admin Login.
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            config(['auth.guards.api.provider' => 'admin']);
            $token = Auth::guard('admin')->user()->createToken('MyApp',['admin'])->accessToken;

            return response()->json([
                'message' => 'Logado com sucesso.',
                'token' => $token
            ], 200);
        }

        return response()->json([
            'error' => 'Email ou Senha errado.'
        ], 400);
    }
    /**
     * Admin Logout.
     */
    public function logout()
    {
        if (Auth::check()) {
            $access_token = auth()->user()->token();
            $tokenRepository = app(TokenRepository::class);
            $tokenRepository->revokeAccessToken($access_token->id);

            return response()->json([
                'message' => 'Deslogado com sucesso.'
            ], 200);
        }

        return Response()->json([
            'error' => 'Sem Acesso.'
        ], 403);
    }
    /**
     * Get Admin Details.
     */
    public function getAdminDetail(): \Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            return Response()->json([
                'data' => Auth::user()
            ], 200);
        }

        return Response()->json([
            'error' => 'Sem Acesso.'
        ], 403);
    }
}
