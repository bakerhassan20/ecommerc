<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
                'name' => ['required'],
                'price' => ['required'],
                'image' => ['required','mimes:png,jpg,jpeg'],
                'image2' => ['required','mimes:png,jpg,jpeg'],
                'sales' => ['required'],
                'offer' => ['required'],
            ];
    }
}
