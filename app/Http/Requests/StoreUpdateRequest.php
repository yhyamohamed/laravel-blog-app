<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|min:3',
            'description' => 'required|min:3',
            'user_id' => 'required|exists:users,id',
        ];
    }
    public function messages()
{
    return [
        'title.required' => 'A title is required',
        'description.required' => 'A description is required',
        'user_id.required' => 'pls select a user',
        'user_id.exists' => 'pls select a user that exists'
    ];
}
}
