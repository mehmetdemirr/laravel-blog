<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            "name"=> ["required","string","max:255"], 
            "slug"=> ["required","string","max:255"],
            "status"=> ["boolean"],
            "desciption"=> ["max:255"],
            // "parent_id"=> ["integer","exists:categories"],
            // "order"=> ["integer"],
            "seo_keywords"=> ["max:255"],
            "seo_desciption"=> ["max:255"],
            "user_id"=> ["exists:users"],
        ];
    }
    public function messages(): array{
        return [
            "name.required"=> "Kategori adı zorunludur !",
            "name.max"=> "Kategori adı en fazla 255 kara kter olabilir !",
            "slug.required"=> "Slug adı zorunludur !",
            "slug.max"=> "Slug en fazla 255 karakter olabilir !",
            "desciption.max"=> "Açıklama en fazla 255 karakter olabilir !",
            "seo_keywords.max"=> "Seo kelimeleri en fazla 255 karakter olabilir !",
            "seo_desciption.max"=> "Seo açıklama en fazla 255 karakter olabilir !",
        ] ;
    }
}
