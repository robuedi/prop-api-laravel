<?php


namespace App\Http\Requests\v1;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class RolesUserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('roles_user')->user_id === auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_completed' => 'integer|min:0|max:1'
        ];
    }
}
