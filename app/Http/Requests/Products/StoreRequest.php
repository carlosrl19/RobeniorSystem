<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_code' => 'required|string|max:10',
            'product_nomenclature' => 'required|string|max:20|unique:products',
            'product_name' => 'required|string|max:55|unique:products|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ,.\s]+$/|',
            'product_brand' => 'required|string|max:20|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ,.\s]+$/|',
            'product_model' => 'nullable|string|max:20|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ,.\s]+$/|',
            'product_status' => 'required|integer|in:0,1,2,3',
            'product_stock' => 'required|integer',
            'product_price' => 'required|numeric|between:0,99999999.99',
            'product_description' => 'nullable|string|max:600',
            'product_status_description' => 'required|string|max:600',
            'product_image' => 'required',
            'product_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,heic,jfif|max:12000',
            'product_reviewed_by' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'product_code.required' => 'El código es obligatorio.',
            'product_code.string' => 'El código debe ser una cadena de texto.',
            'product_code.max' => 'El código no puede tener más de 10 caracteres.',

            'product_nomenclature.required' => 'La nomenclatura es obligatoria.',
            'product_nomenclature.string' => 'La nomenclatura debe ser una cadena de texto.',
            'product_nomenclature.max' => 'La nomenclatura no puede tener más de 5 caracteres.',
            'product_nomenclature.unique' => 'La nomenclatura ya existe.',

            'product_name.required' => 'El nombre es obligatorio.',
            'product_name.string' => 'El nombre debe ser una cadena de texto.',
            'product_name.max' => 'El nombre no puede tener más de 55 caracteres.',
            'product_name.unique' => 'El nombre ya existe.',
            'product_name.regex' => 'El nombre solo debe contener letras, puntos y/o números.',

            'product_brand.required' => 'La marca es obligatoria.',
            'product_brand.string' => 'La marca debe ser una cadena de texto.',
            'product_brand.max' => 'La marca no puede tener más de 20 caracteres.',
            'product_brand.regex' => 'La marca solo debe contener letras, puntos y/o números.',

            'product_model.string' => 'El modelo debe ser una cadena de texto.',
            'product_model.max' => 'El modelo no puede tener más de 20 caracteres.',
            'product_model.regex' => 'El modelo solo debe contener letras, puntos y/o números.',

            'product_status.required' => 'El estado es obligatorio.',
            'product_status.integer' => 'El estado debe ser un número entero.',
            'product_status.in' => 'El estado debe estar entre 0 y 3.',

            'product_stock.required' => 'El stock es obligatorio.',
            'product_stock.integer' => 'El stock debe ser un número entero.',

            'product_price.required' => 'El precio es obligatorio.',
            'product_price.numeric' => 'El precio debe ser un número.',
            'product_price.between' => 'El precio debe estar entre 0 y 99,999,999.99.',

            'product_description.string' => 'La descripción debe ser una cadena de texto.',
            'product_description.max' => 'La descripción no puede tener más de 600 caracteres.',

            'product_status_description.required' => 'La descripción del estado es obligatoria.',
            'product_status_description.string' => 'La descripción del estado debe ser una cadena de texto.',
            'product_status_description.max' => 'La descripción del estado no puede tener más de 600 caracteres.',

            'product_image.required' => 'La imagen es obligatoria.',
            'product_image.*.image' => 'La imagen debe ser una imagen válida.',
            'product_image.*.mimes' => 'La imagen debe ser una imagen con extensión jpeg, png, jpg, gif, heic o jfif.',
            'product_image.*.max' => 'La imagen es demasiado pesada (MAX 12MB).'
        ];
    }
}
