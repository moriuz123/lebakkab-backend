<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $opdId = $request->query('opd_id');
        $opdSlug = $request->query('opd');

        $cacheKey = 'kontak_data_' . ($opdId ?? 'null') . '_' . ($opdSlug ?? 'null');

        return Cache::remember($cacheKey, 3600, function () use ($opdId, $opdSlug) {
            $setting = null;
            $opd = null;

            // Try to fetch specific OPD if requested
            if ($opdId) {
                $opd = Opd::find($opdId);
                $setting = Setting::where('opd_id', $opdId)->first();
            } elseif ($opdSlug) {
                $opd = Opd::where('slug', $opdSlug)->first();
                if ($opd) {
                    $setting = Setting::where('opd_id', $opd->id)->first();
                }
            }

            // Fallback to global setting if no specific setting exists
            if (!$setting) {
                $setting = Setting::whereNull('opd_id')->first();
            }

            // Parse social media JSON from OPD if available
            $opdSocialMedia = [];
            if ($opd && $opd->social_media) {
                $smArray = is_string($opd->social_media) ? json_decode($opd->social_media, true) : $opd->social_media;
                if (is_array($smArray)) {
                    if (isset($smArray[0]) && is_array($smArray[0])) {
                        foreach ($smArray as $item) {
                            if (isset($item['platform'])) {
                                $opdSocialMedia[strtolower($item['platform'])] = $item['url'] ?? '';
                            }
                        }
                    } else {
                        $opdSocialMedia = $smArray;
                    }
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'nama_instansi' => $opd ? $opd->nama : ($setting->satuan_kerja ?? $setting->site_name ?? 'Pemerintah Daerah'),
                    'alamat'        => $opd->alamat ?? $setting->address ?? '',
                    'telepon'       => $opd->telepon ?? $setting->phone ?? '',
                    'email'         => $opd->email ?? $setting->email ?? '',
                    'website'       => $opd->website ?? '',
                    'whatsapp'      => $opdSocialMedia['whatsapp'] ?? $setting->whatsapp ?? '',
                    'facebook'      => $opdSocialMedia['facebook'] ?? $setting->facebook ?? '',
                    'instagram'     => $opdSocialMedia['instagram'] ?? $setting->instagram ?? '',
                    'twitter'       => $opdSocialMedia['twitter'] ?? $opdSocialMedia['x'] ?? $setting->twitter ?? '',
                    'youtube'       => $opdSocialMedia['youtube'] ?? $setting->youtube ?? '',
                    'tiktok'        => $opdSocialMedia['tiktok'] ?? '',
                    'peta_embed'    => $opd->peta_embed ?? $setting->maps_embed ?? '',
                    'maps_link'     => $setting->maps_link ?? '',
                    'logo_url'      => $opd && $opd->logo ? Storage::url($opd->logo) : ($setting && $setting->logo ? Storage::url($setting->logo) : null),
                ],
            ]);
        });
    }
}
