<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    /**
     * Generate a new math captcha question stored in session.
     */
    public function getCaptcha(): JsonResponse
    {
        $num1 = rand(2, 9);
        $num2 = rand(1, 9);
        $op = rand(0, 1) === 1 ? '+' : '+'; // addition for simplicity and clarity
        $answer = $num1 + $num2;

        Session::put('registration_captcha_answer', $answer);

        return response()->json([
            'question' => "What is $num1 $op $num2?",
            'num1' => $num1,
            'num2' => $num2,
        ]);
    }

    /**
     * Handle public pre-registration submission.
     */
    public function store(Request $request): JsonResponse
    {
        // Check if registration is open
        $statusSetting = SiteSetting::where('key', 'registration_status')->first();
        if ($statusSetting && ($statusSetting->value['value'] ?? 'enabled') === 'disabled') {
            $msgSetting = SiteSetting::where('key', 'registration_closed_message')->first();
            $closedMsg = $msgSetting->value['value'] ?? 'Pre-registration is currently closed.';
            return response()->json([
                'success' => false,
                'message' => $closedMsg,
            ], 403);
        }

        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'institution' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'paper_id' => ['nullable', 'string', 'max:100'],
            'captcha_user_answer' => ['required', 'numeric'],
        ], [
            'full_name.required' => 'Full name is required.',
            'email.required' => 'Valid email address is required.',
            'institution.required' => 'Institution / University is required.',
            'category.required' => 'Please select a registration category.',
            'captcha_user_answer.required' => 'Please solve the security captcha.',
        ]);

        $expectedCaptcha = Session::get('registration_captcha_answer');

        if ($expectedCaptcha === null || (int)$request->input('captcha_user_answer') !== (int)$expectedCaptcha) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect Captcha answer. Please try again with the new question.',
                'errors' => ['captcha_user_answer' => ['Security Captcha answer is incorrect.']],
            ], 422);
        }

        // Store registration entry
        $registration = Registration::create([
            'full_name' => trim($request->input('full_name')),
            'email' => trim($request->input('email')),
            'institution' => trim($request->input('institution')),
            'category' => trim($request->input('category')),
            'paper_id' => $request->input('paper_id') ? trim($request->input('paper_id')) : null,
            'status' => 'pending',
            'ip_address' => $request->ip(),
        ]);

        // Clear captcha answer after successful submit
        Session::forget('registration_captcha_answer');

        return response()->json([
            'success' => true,
            'message' => 'Pre-registration submitted successfully! Our team will contact you with payment instructions.',
            'data' => $registration,
        ]);
    }
}
