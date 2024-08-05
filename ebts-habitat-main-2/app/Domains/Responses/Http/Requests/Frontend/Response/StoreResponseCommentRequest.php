<?php

namespace App\Domains\Responses\Http\Requests\Frontend\Response;

use App\Exceptions\GeneralException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreResponseCommentRequest.
 */
class StoreResponseCommentRequest extends FormRequest
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
            'content' => ['required', 'min:1', 'max:200'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'content.required' => __('Debes introducir un pequeño texto (max. 200 caracteres).'),
            'content.min' => __('El texto debe tener como mínimo 1 caracter.'),
            'content.max' => __('El texto debe tener como máximo 200 caracteres.'),
        ];
    }
}
