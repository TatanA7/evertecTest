<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateOrder extends FormRequest
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
            'name'          => 'required|min:3|max:70',
            'email'         => 'required|email',
            'mobile_phone'  => 'required|min:10',
            'article_id'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'El nombre es requerido',
            'name.min'              => 'El nombre debe tener minimo 3 caracteres',
            'name.max'              => 'El nombre tiene mas de :max caracteres',
            'email.email'           => 'Digite un email valido',
            'email.required'        => 'El correo es requerido ',
            'mobile_phone.required' => 'El numero de celular es requerido ',
            'mobile_phone.min'      => 'Numero de telefono tiene menos de :min caracteres',
            'article_id.exists'     => 'Este articulo no existe.',
            'article_id.required'   => 'Debe de elegir un articulo'
        ];
    }
}
