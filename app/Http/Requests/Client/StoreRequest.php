<?php

namespace App\Http\Requests\Client;

use App\Rules\CountryExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreRequest extends FormRequest
{
    /**
     ** Prepare the request for the validation
     *
     * @return self
     */
    public function prepareForValidation(): self
    {
        return $this->merge([
            '_resource_state' => Str::random(64),
            'slug' => Str::slug($this->general['name']),
        ]);
    }

    /**
     ** Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasAnyRole('super-admin', 'Administrator');
    }

    /**
     ** Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            '_resource_state' => 'required|string|size:64',
            'slug' => 'required|string|unique:clients,slug',

            'general' => 'required|array|size:7',
            'general.name' => 'required|string',
            'general.business_name' => 'required|string',
            'general.phone' => 'nullable|string',
            'general.email' => 'required|string|email|unique:clients,email',
            'general.contact_name' => 'nullable|string',
            'general.service_phone' => 'required_if:fulfillment.active,true',
            'general.rfid' => 'required|boolean',

            'address' => 'required|array|size:8',
            'address.country' => ['required', 'string', new CountryExists],
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.neighborhood' => 'required|string',
            'address.street' => 'required|string',
            'address.ext_number' => 'required|numeric',
            'address.int_number' => 'nullable|string',
            'address.zipcode' => 'required|numeric|digits:5',

            'warehouses' => 'required|array',
            'warehouses.*' => 'required|string|uuid|exists:warehouses,id',

            'require_expt_impt' => 'required|array|min:3',
            'require_expt_impt.active' => 'required|boolean',
            'require_expt_impt.ssn' => 'required_if:require_expt_impt.active,true',
            'require_expt_impt.idc' => 'required_if:require_expt_impt.active,true',
            'require_expt_impt.rfe' => 'required_if:require_expt_impt.active,false',
            'require_expt_impt.immex' => 'required_if:require_expt_impt.active,false',

            'notifications' => 'required|array|size:3',
            'notifications.active' => 'required|boolean',
            'notifications.email_notification' => 'required_if:notifications.active,true|string|email',
            'notifications.notification_concept' => 'required_if:notifications.active,true|string',

            'fulfillment' => 'required|array|size:3',
            'fulfillment.active' => 'required|boolean',
            'fulfillment.services' => 'required_if:fulfillment.active,true',
            'fulfillment.accounts' => 'required_if:fulfillment.active,true|array|min:1',
            'fulfillment.accounts.*' => 'required_if:fulfillment.active,true|string|uuid',

        ];
    }
}
