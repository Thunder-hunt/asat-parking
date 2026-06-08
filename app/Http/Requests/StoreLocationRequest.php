<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'location_name' => 'required|string|max:100',
            'max_motorcycle' => 'required|integer|min:0',
            'max_car' => 'required|integer|min:0',
            'max_other' => 'required|integer|min:0',
        ];
    }
}
