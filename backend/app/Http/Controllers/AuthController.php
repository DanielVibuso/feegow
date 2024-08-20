<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }


    /**
     * Login.
     * 
     * Esta api utiliza tokens JWT para autenticação.
     * 
     * @param request request
     * @return json
     */
    public function login(LoginRequest $request)
    {
        try {  
            $data = $this->authService->login($request);

            return response()->json(['data' => $data], 200);
        } catch (InvalidCredentialsException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json('internal error', 422);
        }
    }


    /**
     * Logout
     * 
     * Destrói o token por onde a requisição chegou, fazendo logout do usuário requisitante
     */
    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request);

            return response()->json([], 204);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json('internal error', 422);
        }
    }

    /**
     * Esqueci a senha
     * 
     * Endpoint padrão para recuperação senha
     * @param ForgotPasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $this->authService->forgotPassword($request);

            return response()->json(['message' => 'Password email recover sended'], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json('internal error', 422);
        }
    }

    /**
     * Atualizar a senha esquecida
     * 
     * Endpoint padrão para recuperar a senha em caso de ter solicitado a recuperação
     * @param UpdatePasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            if ($this->authService->updatePassword($request)) {
                return response()->json(['message' => 'password updated'], 200);
            }

            return response()->json(['message' => 'error while updating password'], 422);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json('internal error', 422);
        }
    }
}
