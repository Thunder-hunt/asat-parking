<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVehicleTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $vehicleTypeId = $this->route('vehicle_type'); // Get route parameter for update requests

        return [
            'jenis' => [
                'required',
                Rule::in(['motorcycle', 'car', 'other']),
                Rule::unique('parkir_vehicle_types', 'jenis')->ignore($vehicleTypeId)
            ],
            'perjam_pertama' => 'required|integer|min:0',
            'perjam_berikutnya' => 'required|integer|min:0',
            'max_perhari' => 'required|integer|min:0',
        ];
    }
}
