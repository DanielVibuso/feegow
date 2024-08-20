<?php

namespace App\Http\Controllers;


use App\Http\Requests\Lot\StoreRequest;
use App\Http\Requests\Lot\UpdateRequest;
use App\Http\Resources\LotResource;
use App\Services\LotService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LotController extends Controller
{
    public function __construct(protected LotService $lotService)
    {
    }

    /**
     * Cadastrar lote
     * 
     * Este endpoint é utilizado para cadastrar um novo lote
     */
    public function store(StoreRequest $request)
    {
        try{
            return new LotResource($this->lotService->store($request->validated()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Store lot error', 422);
        }
    }

    /**
     * Listar lotes
     * 
     * Esse endpoint é utilizado para visualizar todos os lotes cadastrados, aceita os parametros de paginação já mencionados
     * ex: per_page, page. Também é possível informar o lot_identify, campo que foi indexado para melhor performance.
     */
    public function index(Request $request)
    {
        try{
            return LotResource::collection($this->lotService->index($request->query()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('List lots error', 422);
        }
    }

    /**
     * Ver dados do lote
     * 
     * Este endpoint retorna os dados do lote informado pelo id
     */
    public function show(String $id)
    {
        try{
            return new LotResource($this->lotService->show($id));
        }catch(ModelNotFoundException $e){
            return response()->json('lot not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Get lot error', 422);
        }
    }

    /**
     * Atualizar dados do lote
     * 
     * é possível atulizar os dados do lote com este endpoint
     */
    public function update(String $id, UpdateRequest $request)
    {
        try{
            return new LotResource($this->lotService->update($id, $request->validated()));
        }catch(ModelNotFoundException $e){
            return response()->json('lot not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Update lot error', 422);
        }
    }

    /**
     * Deletar lote
     * 
     * Remove o lote informado
     */
    public function delete(String $id)
    {
        try{
            $this->lotService->delete($id);
            return response()->noContent();
        }catch(ModelNotFoundException $e){
            return response()->json('lot not found', 404);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Delete lot error', 422);
        }
    }
}
