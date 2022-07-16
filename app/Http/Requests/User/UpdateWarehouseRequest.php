<?php

namespace App\Http\Requests\User;

use App\Models\WarehousesPerUser;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return WarehousesPerUser::whereBelongsTo($this->user())->whereWarehouseId($this->warehouse_id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'warehouse_id' => 'required|string|uuid|exists:warehouses,id',
        ];
    }
}
