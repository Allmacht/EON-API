<?php

namespace App\Http\Requests\ShippingService;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
        ];
    }
}
