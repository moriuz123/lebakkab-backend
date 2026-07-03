<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->updateOrInsert(
            ['id' => 1],
            [
                'site_name'           => 'Portal Pemerintah',
                'site_description'    => 'Situs resmi informasi dan layanan publik.',
                'logo'                => 'logo.png',
                'favicon'             => 'favicon.ico',
                'address'             => 'Jl. Proklamasi No.1, Kabupaten Lebak, Banten',
                'email'               => 'admin@portalpemerintah.go.id',
                'phone'               => '021-123456',
                'whatsapp'            => '081234567890',
                'facebook'            => 'https://facebook.com/portalpemerintah',
                'instagram'           => 'https://instagram.com/portalpemerintah',
                'twitter'             => 'https://twitter.com/portalpemerintah',
                'youtube'             => 'https://youtube.com/portalpemerintah',
                'footer_text'         => '© 2025 Portal Pemerintah. All rights reserved.',
                'meta_keywords'       => 'portal, pemerintah, informasi, layanan, publik',
                'meta_description'    => 'Website resmi pemerintah daerah untuk informasi dan layanan publik.',
                'maintenance_mode'    => false,
                'google_analytics_id' => 'G-XXXXXXXXXX',
                'sematkan_maps'       => '<iframe src="https://maps.google.com/..."></iframe>',
                'link_maps'           => 'https://goo.gl/maps/xxxxxx',
                'foto_bupati'         => 'bupati.jpg',
                'foto_wakil_bupati'   => 'wakil_bupati.jpg',
                'tagline'             => 'Melayani dengan Hati',
                'logo_tagline'        => 'tagline.png',
                'satuan_kerja'        => 'Diskominfo Kabupaten Lebak',
                'updated_at'          => now(),
            ]
        );
    }
}
