<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @return mixed
     */
    public function __invoke(#[CurrentUser] User $user)
    {
        return $user->hasVerifiedEmail()
                    ? redirect()->intended(route('forum.index', absolute: false))
                    : view('auth.verify-email');
    }
}
