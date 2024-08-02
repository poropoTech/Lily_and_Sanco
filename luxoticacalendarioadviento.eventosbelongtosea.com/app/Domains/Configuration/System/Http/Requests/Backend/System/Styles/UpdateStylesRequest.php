<?php

namespace App\Domains\Configuration\System\Http\Requests\Backend\System\Styles;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStylesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'system_design_frontend' => ['string','nullable'],
            'system_design_backend' => ['string','nullable'],
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('No tienes privilegios suficientes'));
    }
}
