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

    public function store(StoreRequest $request)
    {
        try{
            return new EmployeeResource($this->employeeService->store($request->validated()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Store employee error', 422);
        }
    }

    public function index(Request $request)
    {
        try{
            return EmployeeResource::collection($this->employeeService->index($request->query()));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('List employees error', 422);
        }
    }

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
