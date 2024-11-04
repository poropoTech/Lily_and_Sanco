<?php

namespace App\Domains\Common\Rules;

use Illuminate\Contracts\Validation\Rule;
use Cron\CronExpression as CronExpr;

/**
 * Class CronExpression.
 */
class CronExpression implements Rule
{
    public function passes($attribute, $value): bool
    {
        return CronExpr::isValidExpression($value);
    }

    public function message(): string
    {
        return __('La expresión Cron no es válida.');
    }
}
