<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TurnstileCaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('Verifikasi keamanan (CAPTCHA) gagal karena kosong. Silakan coba lagi.');
            return;
        }

        try {
            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                // Menggunakan dummy secret key dari Cloudflare untuk testing, atau dari env jika di production
                'secret' => env('TURNSTILE_SECRET_KEY', '1x0000000000000000000000000000000AA'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            $result = $response->json();

            if (!isset($result['success']) || $result['success'] !== true) {
                Log::warning('Turnstile CAPTCHA Failed', ['result' => $result, 'ip' => request()->ip()]);
                $fail('Verifikasi keamanan (CAPTCHA) tidak valid atau kedaluwarsa. Silakan refresh halaman.');
            }
        } catch (\Exception $e) {
            Log::error('Turnstile CAPTCHA Error: ' . $e->getMessage());
            $fail('Layanan verifikasi keamanan sedang mengalami gangguan.');
        }
    }
}
