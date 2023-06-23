<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Financial;
use App\Models\Moderator;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (Gate::denies('all-users')) {
            return response()->json([
                'message' => 'Todos usuários retornados.',
                'Usuários' => User::all()
            ], 200);
        }

        $users = User::all()->toArray();
        $admins = Admin::all()->toArray();
        $moderators = Moderator::all()->toArray();
        $financials = Financial::all()->toArray();

        return response()->json([
            'message' => 'Todos usuários retornados.',
            'Todos os usuários' => [
                'Usuários' => $users,
                'Administrador' => $admins,
                'Moderadores' => $moderators,
                'Financeiros' => $financials,
            ],
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            'role' => 'required|in:user,admin,moderator,financial',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'available roles' => ['user','admin','moderator','financial_level_1', 'financial_level_2']
            ], 422);
        }

        switch ($validator->validated()['role']) {
            case 'user':
                User::create([
                    'name' => $validator->validated()['name'],
                    'email' => $validator->validated()['email'],
                    'password' => bcrypt($validator->validated()['password'])
                ]);
                break;
            case 'admin':
                Admin::create([
                    'name' => $validator->validated()['name'],
                    'email' => $validator->validated()['email'],
                    'password' => bcrypt($validator->validated()['password'])
                ]);
                break;
            case 'moderator':
                Moderator::create([
                    'name' => $validator->validated()['name'],
                    'email' => $validator->validated()['email'],
                    'password' => bcrypt($validator->validated()['password'])
                ]);
                break;
            case 'financial_level_1':
                Financial::create([
                    'name' => $validator->validated()['name'],
                    'email' => $validator->validated()['email'],
                    'password' => bcrypt($validator->validated()['password']),
                    'level' => 1
                ]);
                break;
            case 'financial_level_2':
                Financial::create([
                    'name' => $validator->validated()['name'],
                    'email' => $validator->validated()['email'],
                    'password' => bcrypt($validator->validated()['password']),
                    'level' => 2
                ]);
                break;
            default:
                return response()->json([
                    'message' => 'Não foi possível criar esse usuário!',
                ], 400);
                break;
        }

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = User::find($id);

        if (!empty($user)) {
            return response()->json([
                'message' => 'Usuário encontrado!',
                'Usuário' => $user
            ], 200);
        }

        return response()->json([
            'error' => 'Usuário não encontrado!',
        ], 404);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        if (Gate::denies('edit-user')) {
            return response()->json([
                'message' => 'Acesso negado!',
            ], 403);
        }

        $user = User::find($id);

        if (!empty($user)) {
            $validators = Validator::make($request->all(), [
                'name'=> 'required|string',
                'email'=> 'required|email'
            ])->safe()->all();

            $user->update($validators);

            return response()->json([
                'message' => 'Usuário atualizado com sucesso!'
            ], 200);
        }

        return response()->json([
            'error' => 'Usuário não encontrado!'
        ], 404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        if (Gate::denies('delete-user')) {
            return response()->json([
                'message' => 'Acesso negado!'
            ], 403);
        }

        $user = User::find($id);

        if (!empty($user)) {
            $user->delete();
            return response()->json([
                'message' => 'Usuário deletado com sucesso!'
            ], 200);
        }

        return response()->json([
            'error' => 'Usuário não encontrado!'
        ], 404);
    }
}
