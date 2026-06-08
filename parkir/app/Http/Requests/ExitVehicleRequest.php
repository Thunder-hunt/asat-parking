<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExitVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_tiket' => 'required|string|exists:parkir_transactions,no_tiket',
            'no_polisi' => 'required|string|max:20',
            'keluar' => 'nullable|date',
        ];
    }
}
