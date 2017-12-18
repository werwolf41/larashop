<?php

namespace App\Http\Requests\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'slug' => 'required|unique:category,slug|max:255',
            'parent' => 'integer|max:10|exist:category:id',
            'image' => 'image|max:255',
            'active' => 'boolean',
            'title'=> 'array,',
            'title.*.name'=>'required|max:255',
            'title.*.category_id'=>'integer|max:10|exist:category:id',
            'title.*.language_id'=>'integer|max:10|exist:languages:id',
            'title.*.meta_title'=>'max:100',
            'title.*.meta_description'=>'max:255',
            ];
    }
}
