<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioRegistroRequest extends Request
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
            'name' => 'required|min:3|max:120|unique:users',
            'email' => 'required|email|min:4|max:250|unique:users',
            'password' => 'required|min:4|max:120|unique:users',
            'type' => 'required',
            'numero_nomina' => 'required',
            'telefono' => 'min:8|max:15',
            'direccion' => 'min:4|max:300'
        ];
    }
}
