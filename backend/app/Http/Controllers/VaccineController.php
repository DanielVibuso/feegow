<?php

namespace App\Http\Controllers;


use App\Http\Requests\Vaccine\StoreRequest;
use App\Http\Requests\Vaccine\UpdateRequest;
use App\Http\Resources\VaccineResource;
use App\Services\VaccineService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VaccineController extends Controller
{
    public function __construct(protected VaccineService $vaccineService)
    {
    }

    /**
     * Cadastrar vacina
     * 
     * Registra uma nova vacina
     */
    public function store(StoreRequest $request)
    {
        try{
            return new VaccineResource($this->vaccineService->store($request->validated()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Store vaccine error', 422);
        }
    }

    /**
     * Lista todas as vacinas cadastradas
     */
    public function index(Request $request)
    {
        try{
            return VaccineResource::collection($this->vaccineService->index($request->query()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('List vaccines error', 422);
        }
    }

    /**
     * Exibir vacina
     * 
     * Exibe uma vacina pelo seu id
     */
    public function show(String $id)
    {
        try{
            return new VaccineResource($this->vaccineService->show($id));
        }catch(ModelNotFoundException $e){
            return response()->json('vaccine not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Get vaccine error', 422);
        }
    }

    /**
     * atualizar vacina
     * 
     * Este endpoint atualiza a vacina com o id informado
     */
    public function update(String $id, UpdateRequest $request)
    {
        try{
            return new VaccineResource($this->vaccineService->update($id, $request->validated()));
        }catch(ModelNotFoundException $e){
            return response()->json('vaccine not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Update vaccine error', 422);
        }
    }

    /**
     * Deletar vacina
     * 
     * Este endpoint deleta a vacina informada
     */
    public function delete(String $id)
    {
        try{
            $this->vaccineService->delete($id);
            return response()->noContent();
        }catch(ModelNotFoundException $e){
            return response()->json('vaccine not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Delete vaccine error', 422);
        }
    }
}
