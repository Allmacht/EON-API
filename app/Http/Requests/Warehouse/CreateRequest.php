<?php

namespace App\Http\Requests\Warehouse;

use App\Rules\CountryExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateRequest extends FormRequest
{
    /**
     * The slug is added to the parameters
     *
     * @return self
     */
    public function prepareForValidation(): self
    {
        return $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('super-admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:warehouses,name',
            'slug' => 'required|string|unique:warehouses,slug',
            'country' => ['required', 'string', new CountryExists],
            'state' => 'required|string',
            'city' => 'required|string',
            'neighborhood' => 'required|string',
            'street' => 'required|string',
            'ext_number' => 'required|numeric',
            'int_number' => 'nullable|string',
            'zipcode' => 'required|numeric|digits_between:5,10',
            'phone' => 'nullable|string',
            'map' => 'nullable|string',
        ];
    }

    /**
     * error messages are obtained to return them to the user
     *
     * @return array<string>
     */
    public function messages()
    {
        return [
            'name.unique' => 'El nombre del almacén ya está en uso.',
            'slug.unique' => 'Error al generar Slug, el nombre del almacén ya está en uso.',
        ];
    }
}
