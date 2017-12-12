<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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
        $language = $this->route('language');
        return [
            'name' => 'required|max:255|unique:languages,name,' . $language,
            'code' => 'required|max:50|unique:languages,code,' . $language,
            'active' => 'boolean|required_if:primary,1',
            'primary' => 'boolean',
        ];
    }
}
