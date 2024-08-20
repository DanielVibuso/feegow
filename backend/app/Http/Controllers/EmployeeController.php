<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $employeeService)
    {
    }

    /**
     * Cadastrar funcionário
     * 
     * Endpoint utilizado para cadastrar funcionários.
     */
    public function store(StoreRequest $request)
    {
        try{
            return new EmployeeResource($this->employeeService->store($request->validated()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Store employee error', 422);
        }
    }

    /**
     * Listar funcionários
     * 
     * Endpoint que retorna os funcionários de forma paginada, informar na url os query params possíveis para a paginação
     * os quais são: per_page, page. também é possível filtrar pelo cpf, campo no qual foi criado índice para melhor performance
     */
    public function index(Request $request)
    {
        try{
            return EmployeeResource::collection($this->employeeService->index($request->query()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('List employees error', 422);
        }
    }

    /**
     * Exibir funcionário
     * 
     * Exibe um funcionário, utilizando o id informado.
     */
    public function show(String $id)
    {
        try{
            return new EmployeeResource($this->employeeService->show($id));
        }catch(ModelNotFoundException $e){
            return response()->json('employee not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Get employee error', 422);
        }
    }

    /**
     * Atualizar funcionário
     * 
     * Atualiza os dados do funcionário informado
     */
    public function update(String $id, UpdateRequest $request)
    {
        try{
            return new EmployeeResource($this->employeeService->update($id, $request->validated()));
        }catch(ModelNotFoundException $e){
            return response()->json('employee not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Update employee error', 422);
        }
    }

    /**
     * Deletar funcionário
     * 
     * Remove o usuário pertencente ao id informado
     */
    public function delete(String $id)
    {
        try{
            $this->employeeService->delete($id);
            return response()->noContent();
        }catch(ModelNotFoundException $e){
            return response()->json('employee not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Delete employee error', 422);
        }
    }
}
