<?php

namespace App\Http\Requests;

use App\Rules\ValidateUserPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSecurityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', 'string', 'min:6', new ValidateUserPasswordRule($this->user()->password)],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
}
