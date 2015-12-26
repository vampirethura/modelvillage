<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use \Auth;

class CreatePostRequest extends Request
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
        'description'=>'required',
        'photo'=>'required|max:1000|mimes:jpeg,jpg,jpe,bmp,png'
      ];
    }
}
