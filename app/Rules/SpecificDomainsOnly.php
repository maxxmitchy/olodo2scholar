<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SpecificDomainsOnly implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $domain = substr($value, strpos($value, '@') + 1);

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
