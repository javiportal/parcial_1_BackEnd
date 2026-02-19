<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'id_libro' => 'required|exists:books,id',
            'nombre_solicitante' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'id_libro.required'=> 'El id del libro es un campo obligatorio',
            'id_libro.exists'=> 'El libro no existe',
            'nombre_solicitante.required' => 'El nombre del solicitante es obligatorio',
        ];
    }
}