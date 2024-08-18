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

    public function store(StoreRequest $request)
    {
        try{
            return new VaccineResource($this->vaccineService->store($request->validated()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Store vaccine error', 422);
        }
    }

    public function index(Request $request)
    {
        try{
            return VaccineResource::collection($this->vaccineService->index($request->query()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('List vaccines error', 422);
        }
    }

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
