<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class AgencyAddressStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('agency')->roleUser->user_id === auth()->user()->id ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_id' => 'numeric|required',
            'address_line' => 'string|required',
            'postcode' => 'string|required'
        ];
    }

    public function messages()
    {
        return [
            'city_id.required' => 'The city field is required',
        ];
    }
}
