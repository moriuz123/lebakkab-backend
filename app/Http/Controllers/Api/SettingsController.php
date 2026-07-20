<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function headerData(\Illuminate\Http\Request $request)
    {
        $opdId = $request->query('opd_id');
        $cacheKey = 'settings.header.' . ($opdId ?? 'global');

        $setting = Cache::remember($cacheKey, 3600, function () use ($opdId) {
            $query = Setting::select(
                'site_name',
                'tagline',
                'satuan_kerja',
                'logo',
                'logo_tagline',
                'favicon',
                'photo_bupati',
                'backgrounds',
                'logo_tagline2',
                'logo_tagline3'
            );

            $opdSetting = $opdId ? (clone $query)->where('opd_id', $opdId)->first() : null;
            return $opdSetting ?? $query->whereNull('opd_id')->first();
        });

        // Parse backgrounds JSON and map to URLs
        $backgrounds = is_string($setting->backgrounds) ? json_decode($setting->backgrounds, true) : $setting->backgrounds;
        $backgroundUrls = [];
        if (is_array($backgrounds)) {
            foreach ($backgrounds as $bg) {
                $backgroundUrls[] = Storage::url($bg);
            }
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'site_name'        => $setting->site_name ?? '',
                'tagline'          => $setting->tagline ?? '',
                'satuan_kerja'     => $setting->satuan_kerja ?? '',
                'logo_url'         => $setting && $setting->logo ? Storage::url($setting->logo) : null,
                 'favicon_url'      => $setting && $setting->favicon ? Storage::url($setting->favicon) : null,
                'logo_tagline_url' => $setting && $setting->logo_tagline ? Storage::url($setting->logo_tagline) : null,
                'photo_bupati'     => $setting && $setting->photo_bupati ? Storage::url($setting->photo_bupati) : null,
                'backgrounds'       => $backgroundUrls,
                'logo_tagline2_url' => $setting && $setting->logo_tagline2 ? Storage::url($setting->logo_tagline2) : null,
                'logo_tagline3_url' => $setting && $setting->logo_tagline3 ? Storage::url($setting->logo_tagline3) : null,
            ],
        ]);
    }

    public function footerData(\Illuminate\Http\Request $request)
    {
        $opdId = $request->query('opd_id');
        $cacheKey = 'settings.footer.' . ($opdId ?? 'global');

        $setting = Cache::remember($cacheKey, 3600, function () use ($opdId) {
            $query = Setting::select(
                'site_name',
                'satuan_kerja',
                'logo',
                'address',
                'phone',
                'email',
                'facebook',
                'instagram',
                'twitter',
                'youtube',
                'whatsapp',
                'footer_text',
                'backgrounds',
                'logo_tagline2',
                'logo_tagline3'
            );

            $opdSetting = $opdId ? (clone $query)->where('opd_id', $opdId)->first() : null;
            return $opdSetting ?? $query->whereNull('opd_id')->first();
        });

        return response()->json([
            'status' => 'success',
            'data'   => [
                'site_name'    => $setting->site_name ?? '',
                'satuan_kerja' => $setting->satuan_kerja ?? '',
                'logo_url'     => $setting && $setting->logo ? Storage::url($setting->logo) : null,
                'address'      => $setting->address ?? '',
                'phone'        => $setting->phone ?? '',
                'email'        => $setting->email ?? '',
                'facebook'     => $setting->facebook ?? '',
                'instagram'    => $setting->instagram ?? '',
                'twitter'      => $setting->twitter ?? '',
                'youtube'      => $setting->youtube ?? '',
                'whatsapp'     => $setting->whatsapp ?? '',
                'footer_text'  => $setting->footer_text ?? '© ' . date('Y') . ' ' . ($setting->site_name ?? 'Website'),
                'logo_tagline2_url' => $setting && $setting->logo_tagline2 ? Storage::url($setting->logo_tagline2) : null,
                'logo_tagline3_url' => $setting && $setting->logo_tagline3 ? Storage::url($setting->logo_tagline3) : null,
            ],
        ]);
    }
}
