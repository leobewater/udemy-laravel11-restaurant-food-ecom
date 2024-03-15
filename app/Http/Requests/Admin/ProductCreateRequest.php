<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'max:3072'],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'offer_price' => ['nullable', 'numeric'],
            'short_description' => ['required', 'string', 'max:500'],
            'long_description' => ['required'],
            'sku' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'max:255'],
            'seo_description' => ['nullable'],
            'status' => ['boolean'],
            'show_at_home' => ['boolean'],
        ];
    }
}
