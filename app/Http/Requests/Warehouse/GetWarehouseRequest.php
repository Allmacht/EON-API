<?php

namespace App\Http\Requests\Warehouse;

use App\Models\WarehousesPerUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class GetWarehouseRequest extends FormRequest
{
    /**
     * It validates that the entered UUID is valid, if not, it aborts with a 422 error
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'warehouse' => Str::isUuid($this->route()->warehouse) ? $this->route()->warehouse : null,
        ]);

        abort_if($this->warehouse === null, 422, 'The uuid provided is invalid, please check and try again.');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return WarehousesPerUser::whereWarehouseId($this->warehouse)->whereUserId($this->user()->id)->exists() || $this->user()->hasAnyRole('super-admin', 'Administrator');
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
        ];
    }
}
