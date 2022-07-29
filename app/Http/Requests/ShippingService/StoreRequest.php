<?php

namespace App\Http\Requests\ShippingService;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole('super-admin', 'Administrator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:shipping_services,name',
            'email' => 'nullable|string|email',
            'contact' => 'nullable|string',
            'phone' => 'nullable|string',
            'image' => 'nullable|file|image|max:5120',
        ];
    }

    /**
     * The messages that are returned to the user are obtained
     *
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'El nombre ingresado ya está en uso',
            'image.image' => 'El archivo ingresado no es válido',
            'image.max' => 'El tamaño de la imagen no debe superar los 5MB',
        ];
    }
}
