<?php

namespace App\Http\Requests\ShippingService;

use Illuminate\Foundation\Http\FormRequest;

class GetShippingServiceRequest extends FormRequest
{
    /**
     * the id is added to the parameters
     *
     * @return self
     */
    public function prepareForValidation()
    {
        return $this->merge([
            'shipping_service' => $this->route()->shipping_service,
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
            'shipping_service' => 'required|string|uuid|exists:shipping_services,id',
        ];
    }
}
