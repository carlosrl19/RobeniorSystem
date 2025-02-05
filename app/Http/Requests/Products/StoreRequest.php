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
            'product_nomenclature' => 'required|string|max:5|unique:products',
            'product_name' => 'required|string|max:55|unique:products|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ,.\s]+$/|',
            'product_brand' => 'required|string|max:20',
            'product_model' => 'nullable|string|max:20',
            'product_status' => 'required|integer|in:0,1,2,3',
            'product_stock' => 'required|integer',
            'product_price' => 'required|numeric|between:0,99999999.99',
            'product_description' => 'nullable|string|max:600',
            'product_status_description' => 'required|string|max:600',
            'product_image' => 'required',
            'product_image.*' => 'image',
            'product_reviewed_by' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'product_code.required' => 'El código del producto es obligatorio.',
            'product_code.string' => 'El código del producto debe ser una cadena de texto.',
            'product_code.max' => 'El código del producto no puede tener más de 10 caracteres.',

            'product_nomenclature.required' => 'La nomenclatura del producto es obligatoria.',
            'product_nomenclature.string' => 'La nomenclatura del producto debe ser una cadena de texto.',
            'product_nomenclature.max' => 'La nomenclatura del producto no puede tener más de 5 caracteres.',
            'product_nomenclature.unique' => 'La nomenclatura del producto ya existe.',

            'product_name.required' => 'El nombre del producto es obligatorio.',
            'product_name.string' => 'El nombre del producto debe ser una cadena de texto.',
            'product_name.max' => 'El nombre del producto no puede tener más de 55 caracteres.',
            'product_name.unique' => 'El nombre del producto ya existe.',
            'product_name.regex' => 'El nombre del producto solo debe contener letras, puntos y/o números.',

            'product_brand.required' => 'La marca del producto es obligatoria.',
            'product_brand.string' => 'La marca del producto debe ser una cadena de texto.',
            'product_brand.max' => 'La marca del producto no puede tener más de 20 caracteres.',

            'product_model.string' => 'El modelo del producto debe ser una cadena de texto.',
            'product_model.max' => 'El modelo del producto no puede tener más de 20 caracteres.',

            'product_status.required' => 'El estado del producto es obligatorio.',
            'product_status.integer' => 'El estado del producto debe ser un número entero.',
            'product_status.in' => 'El estado del producto debe estar entre 0 y 3.',

            'product_stock.required' => 'El stock del producto es obligatorio.',
            'product_stock.integer' => 'El stock del producto debe ser un número entero.',

            'product_price.required' => 'El precio del producto es obligatorio.',
            'product_price.numeric' => 'El precio del producto debe ser un número.',
            'product_price.between' => 'El precio del producto debe estar entre 0 y 99,999,999.99.',

            'product_description.string' => 'La descripción del producto debe ser una cadena de texto.',
            'product_description.max' => 'La descripción del producto no puede tener más de 600 caracteres.',

            'product_status_description.required' => 'La descripción del estado del producto es obligatoria.',
            'product_status_description.string' => 'La descripción del estado del producto debe ser una cadena de texto.',
            'product_status_description.max' => 'La descripción del estado del producto no puede tener más de 600 caracteres.',

            'product_image.required' => 'La imagen del producto es obligatoria.',
            'product_image.*' => 'La imagen del producto debe ser una imagen válida.',
        ];
    }
}
