<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TareaRegistroRequest extends Request
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
            'nombre_tarea' => 'required|min:4|max:120|required|unique:tarea',
            'status_tarea' =>'required',
            'descripcion_tarea' => 'min:4|max:250',
            'fecha_inicio' => 'required',
            'fecha_limite' => 'required',
            'prioridad_tarea' => 'required'
        ];
    }
}
