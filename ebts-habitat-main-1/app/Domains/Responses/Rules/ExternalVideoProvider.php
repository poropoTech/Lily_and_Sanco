<?php

namespace App\Domains\Responses\Rules;

use App\Domains\Responses\Models\Response;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class ExternalVideoProviders.
 */
class ExternalVideoProvider implements Rule
{


    public function passes($attribute, $value): bool
    {
        foreach (Response::externalVideoProviders as $provider) {
            if (strstr($value, $provider)) {
                return true;
            }
        }

        return false;
    }

    public function message(): string
    {
        return __('El proveedor de video no está soportado.');
    }
}
