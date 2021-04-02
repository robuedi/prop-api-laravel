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
            'name' => 'string|required'
        ];
    }

    public function messages()
    {
        return [
            'status_id.required' => 'The status field is required.'
        ];
    }
}
