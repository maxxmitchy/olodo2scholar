<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class SpecificDomainsOnly implements Rule
{
    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        $domain = mb_substr($value, mb_strpos($value, '@') + 1);

        $domains = [
            'gmail.com',
            'hotmail.com',
            'yahoo.com',
            'yopmail.com',
        ];

        return in_array($domain, $domains);
    }

    public function message()
    {
        return 'The email must be a valid domain.';
    }
}
