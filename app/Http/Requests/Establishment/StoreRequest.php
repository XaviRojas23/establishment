<?php

namespace App\Http\Requests\Establishment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'image_principal' => 'required|image|max:1000',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'tlf' => 'required|numeric',
            'description' => 'required|min:50',
            'opening' => 'date_format:H:i',
            'closing' => 'date_format:H:i|after:opening',
            'uuid' => 'required|uuid',
        ];
    }
}
