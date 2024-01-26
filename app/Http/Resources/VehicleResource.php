<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $model
 * @property mixed $plate_number
 * @property mixed $insurance_date
 * @property mixed $brand
 */
class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'brand' => strtoupper($this->brand),
            'model' => strtoupper($this->model),
            'plate_number' => $this->plate_number,
            'insurance_date' => $this->insurance_date,
        ];
    }
}
