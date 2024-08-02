<?php

namespace App\Domains\Structure\Rules\Activity;

use App\Domains\Responses\Models\Response;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class ResponseTypes.
 */
class ResponseTypes implements Rule
{
    public function passes($attribute, $value): bool
    {
        foreach (Response::TYPES as $type) {
            if ($type['id'] == $value) {
                return true;
            }
        }
        return false;
    }

    public function message(): string
    {
        return __('El tipo de respuesta no es válido.');
    }
}
