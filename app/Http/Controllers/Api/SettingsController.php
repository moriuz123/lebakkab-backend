<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function headerData()
    {
        $setting = Setting::select(
            'site_name',
            'tagline',
            'satuan_kerja',
            'logo',
            'logo_tagline',
            'favicon',
            'photo_bupati'
        )->first();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'site_name'        => $setting->site_name ?? '',
                'tagline'          => $setting->tagline ?? '',
                'satuan_kerja'     => $setting->satuan_kerja ?? '',
                'logo_url'         => $setting && $setting->logo ? asset('storage/' . $setting->logo) : null,
                 'favicon_url'      => $setting && $setting->favicon ? asset('storage/' . $setting->favicon) : null,
                'logo_tagline_url' => $setting && $setting->logo_tagline ? asset('storage/' . $setting->logo_tagline) : null,
                'photo_bupati'     => $setting && $setting->photo_bupati ? asset('storage/' . $setting->photo_bupati) : null,
            ],
        ]);
    }

    public function footerData()
    {
        $setting = Setting::select(
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
            'footer_text'
        )->first();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'site_name'    => $setting->site_name ?? '',
                'satuan_kerja' => $setting->satuan_kerja ?? '',
                'logo_url'     => $setting && $setting->logo ? asset('storage/' . $setting->logo) : null,
                'address'      => $setting->address ?? '',
                'phone'        => $setting->phone ?? '',
                'email'        => $setting->email ?? '',
                'facebook'     => $setting->facebook ?? '',
                'instagram'    => $setting->instagram ?? '',
                'twitter'      => $setting->twitter ?? '',
                'youtube'      => $setting->youtube ?? '',
                'whatsapp'     => $setting->whatsapp ?? '',
                'footer_text'  => $setting->footer_text ?? '© ' . date('Y') . ' ' . ($setting->site_name ?? 'Website'),
            ],
        ]);
    }
}
