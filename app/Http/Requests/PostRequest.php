<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'images' => 'required|array',
            'images.*' => 'required|file|mimes:jpg,jpeg,png',
            'title' => 'required',
            'body' => 'required|min:6',
            'categories' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'categories.required' => 'Choose one or more category',
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }
}
