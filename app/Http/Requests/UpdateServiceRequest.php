<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name' => 'required|string',
            'price' => 'required|max:10',
            'description'=>'required',
            'count'=> 'nullable|max:10',
            'rate'=> 'nullable|max:1',
            'area'=> 'nullable|string',
            'long' => 'nullable|between:-180,180',
            'lat' => 'nullable|between:-90,90',
            'discount'=> 'nullable|max:2',
            'size_id'=> 'nullable',
            'category_id'=> 'required|exists:categories,id',
            'date_from'=> 'nullable|date|before_or_equal:date_to',
            'date_to'=> 'nullable|date|after_or_equal:date_from ',
        ];
    }
}
