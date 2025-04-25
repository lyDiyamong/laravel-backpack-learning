<?php

namespace App\Http\Requests;

class ProductWithImagesRequest extends ProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        // Add validation for images
        $rules['images'] = 'array';
        $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';

        return $rules;
    }
}
