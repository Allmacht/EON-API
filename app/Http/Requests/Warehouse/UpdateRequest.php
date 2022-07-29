<?php

namespace App\Http\Requests\Warehouse;

use App\Rules\CountryExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Prepare the request for validation
     *
     * @return self
     */
    public function prepareForValidation(): self
    {
        $slug = Str::slug($this->name);

        return $this->merge([
            'slug' => $slug,
            'warehouse' => $this->route()->warehouse,
        ]);
    }

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
            'warehouse' => 'required|string|uuid|exists:warehouses,id',
            'name' => ['required', 'string', Rule::unique('warehouses')->ignore($this->warehouse)],
            'slug' => ['required', 'string', Rule::unique('warehouses')->ignore($this->warehouse)],
            'country' => ['required', 'string', new CountryExists],
            'state' => 'required|string',
            'neighborhood' => 'required|string',
            'street' => 'required|string',
            'ext_number' => 'required|numeric',
            'int_number' => 'nullable',
            'zipcode' => 'required|numeric|digits:5',
            'phone' => 'nullable|string',
            'map' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'El nombre del almacén ya está en uso.',
            'slug.unique' => 'Error al generar Slug, el nombre del almacén ya está en uso.',
        ];
    }
}
