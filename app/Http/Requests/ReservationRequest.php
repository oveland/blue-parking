<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parkingType' => 'required',
            'vehicle.plate' => 'required',
            'zone.id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'vehicle.plate.required' => 'Vehicle plate is required',
            'zone.id.required' => 'Zone is required',
        ];
    }
}
