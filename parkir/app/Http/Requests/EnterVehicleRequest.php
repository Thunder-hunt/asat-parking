<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_polisi' => 'required|string|max:20',
            'id_lokasi' => 'required|exists:parkir_locations,id',
            'id_jenis' => 'required|exists:parkir_vehicle_types,id',
        ];
    }
}
