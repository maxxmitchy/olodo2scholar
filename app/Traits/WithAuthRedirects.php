<?php

declare(strict_types=1);

namespace App\Traits;

trait WithAuthRedirects
{
    public function redirectToLogin()
    {
        redirect()->setIntendedUrl(url()->previous());

        return redirect()->route('login');
    }

    public function redirectToRegister()
    {
        redirect()->setIntendedUrl(url()->previous());

        return redirect()->route('premium');
    }
}
