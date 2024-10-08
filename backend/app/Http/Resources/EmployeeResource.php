<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'name' => $this->name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'cpf' => $this->cpf,
            'comorbidity' => $this->comorbidity,
            'birth_date' => $this->birth_date
        ];
    }
}
