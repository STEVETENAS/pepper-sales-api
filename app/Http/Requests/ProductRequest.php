<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    { return true; }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'title' => ['sometimes','min:3','max:25','string'.$this['products']],
                'price' => ['sometimes','numeric'],
                'weight' => ['sometimes','numeric'],
                'description' => ['sometimes','string'],
            ];
        }
        return [
            'title' => ['required','string'],
            'price' => ['required','numeric'],
            'weight' => ['required','numeric'],
            'description' => ['string'],
        ];
    }
}
