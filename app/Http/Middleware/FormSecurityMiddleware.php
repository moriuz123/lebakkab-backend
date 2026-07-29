<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Rules\TurnstileCaptcha;

class FormSecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Honeypot Check
        // 'website_url_hp' is the hidden field we will add to all public forms.
        if ($request->filled('website_url_hp')) {
            return response()->json([
                'success' => false,
                'message' => 'Aktivitas mencurigakan terdeteksi (Bot). Permintaan ditolak.',
            ], 422);
        }

        // 2. Turnstile CAPTCHA Check
        $validator = Validator::make($request->all(), [
            'cf-turnstile-response' => ['required', new TurnstileCaptcha()]
        ], [
            'cf-turnstile-response.required' => 'Verifikasi keamanan (CAPTCHA) wajib diisi.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('cf-turnstile-response'),
                'errors' => $validator->errors()
            ], 422);
        }

        // 3. Input Sanitization (Basic XSS protection for all string inputs)
        $input = $request->all();
        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                $value = strip_tags($value);
            }
        });
        $request->merge($input);

        return $next($request);
    }
}
