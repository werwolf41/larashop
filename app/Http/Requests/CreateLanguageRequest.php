<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLanguageRequest extends FormRequest
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
            'name' => 'required|unique:languages,name|max:255',
            'code' => 'required|unique:languages,code|max:50',
            'active' => 'boolean|required_if:primary,1',
            'primary' => 'boolean',
        ];
    }
}
