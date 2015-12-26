<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use \Auth;

class UpdateFeatureFromRequest extends Request
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
          'name'=>'required',
          'url'=>'required',
          'icon'=>'required',
          'module'=>'required'
        ];
    }
}
