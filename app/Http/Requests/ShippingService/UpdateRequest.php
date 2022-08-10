<?php

namespace App\Http\Requests\ShippingService;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * The shipping service's id is added for validation
     *
     * @return self
     */
    public function prepareForValidation(): self
    {
        return $this->merge([
            'id' => $this->route()->shipping_service,
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasAnyRole('super-admin', 'Administrator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|string|uuid|exists:shipping_services,id',
            'name' => ['required', 'string', Rule::unique('shipping_services')->ignore($this->id)],
            'email' => 'nullable|string|email',
            'contact' => 'nullable|string',
            'phone' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ];
    }

    /**
     * The messages that are returned to the user are obtained
     *
     * @return array<string, string>
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
