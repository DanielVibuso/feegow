<?php

namespace App\Http\Controllers;

use App\Exceptions\EarlyToBoosterException;
use App\Exceptions\LotExpiredException;
use App\Exceptions\SingleShotException;
use App\Http\Requests\EmployeeLot\StoreRequest;
use App\Http\Resources\EmployeeLotResource;
use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeLotService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeLotController extends Controller
{
    public function __construct(protected EmployeeLotService $employeeLotService)
    {
    }

    public function attach(StoreRequest $storeRequest, string $employee, string $lot)
    {
        try{
            return new EmployeeResource($this->employeeLotService->attach($storeRequest->validated(), $employee, $lot));
        }catch(SingleShotException $e){
            return response()->json('Single shot vaccine applied before, can not apply new', 422);
        }catch(EarlyToBoosterException $e){
            return response()->json('Too early to booster', 422);
        }catch(LotExpiredException $e){
            return response()->json('Lot had already expired on the applied date provided and could not have been used', 422);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Attach lot shoot error', 422);
        }
    }

    public function detach(string $employee, string $lot)
    {
        try{
            return new EmployeeResource($this->employeeLotService->detach($employee, $lot));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Detach lot shoot error', 422);
        }
    }

    public function index(Request $request, string $employee)
    {
        try{
            return EmployeeLotResource::collection($this->employeeLotService->index($request->all(), $employee));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('List lot shoot error', 422);
        }
    }

    public function update(Request $request, string $employee, string $lot)
    {
        try{
            return new EmployeeResource($this->employeeLotService->update($request->validated(), $employee, $lot));
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json('Update lot shoot error', 422);
        }
    }
}
