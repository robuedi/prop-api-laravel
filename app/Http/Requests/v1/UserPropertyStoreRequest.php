<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UserPropertyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('user')->id === auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status_id' => 'required',
            'name' => 'string|required',
            'address.city_id' => 'required_if:status_id,=,1|exists:cities,id',
            'address.address_line' => 'required_if:status_id,=,1',
            'address.postcode' => 'required_if:status_id,=,1',
        ];
    }

    public function messages()
    {
        return [
            'status_id.required' => 'The status field is required.',
            'address.city_id.required_if' => 'The city field is required if the property is active.',
            'address.address_line.required_if' => 'The address line field is required if the property is active.',
            'address.postcode.required_if' => 'The postcode field is required if the property is active.'
        ];
    }
}
