<?php

namespace App\Http\Requests\v1;

use App\Models\PropertyRoleUser;
use App\Models\RoleUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class RoleUserPropertyApplicationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Log::info($this->get('property_id'));
        Log::info($this->route('role_user')->appliedProperties()->find($this->get('property_id')));
        return !$this->route('role_user')->appliedProperties()->find($this->get('property_id'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_id' => 'numeric|required'
        ];
    }
}
