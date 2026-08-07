<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function create(): View
    {
        $num1 = rand(2, 9);
        $num2 = rand(1, 9);
        $answer = $num1 + $num2;
        session(['admin_login_captcha' => $answer]);

        return view('admin.auth.login', [
            'captchaQuestion' => "What is $num1 + $num2?",
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $expectedCaptcha = session('admin_login_captcha');

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'captcha_answer' => ['required', 'numeric'],
        ], [
            'captcha_answer.required' => 'Please solve the security captcha.',
            'captcha_answer.numeric' => 'Security captcha must be a number.',
        ]);

        if ($expectedCaptcha === null || (int) $request->input('captcha_answer') !== (int) $expectedCaptcha) {
            $num1 = rand(2, 9);
            $num2 = rand(1, 9);
            session(['admin_login_captcha' => $num1 + $num2]);

            throw ValidationException::withMessages([
                'captcha_answer' => 'Security Captcha answer is incorrect. Please try again.',
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            $num1 = rand(2, 9);
            $num2 = rand(1, 9);
            session(['admin_login_captcha' => $num1 + $num2]);

            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        if (! $request->user()->canAccessAdmin()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Your account is not authorised to access the administration panel.',
            ]);
        }

        session()->forget('admin_login_captcha');

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'You have been signed out.');
    }
}
