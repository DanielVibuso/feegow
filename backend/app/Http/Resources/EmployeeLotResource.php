<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeLotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vaccine' => $this->lot->vaccine->name,
            'employee' => $this->employee->name,
            'lot_identify' => $this->lot->lot_identify,
            'next_shot' => $this->next_shot,
            'shot_number' => $this->shot_number,
            'applied_at' => $this->applied_at,
        ];
    }
}
