<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use \Auth;
class UpdateUserFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'email'=>'required|email',
          'display_name'=>'required|between:3,20',
        ];
    }

    public function messages()
    {
        return [
            'display_name.required' => 'Full Name field is required.',
            'display_name.between' => 'Full Name field must be between :min and :max characters.',
        ];
    }
}
