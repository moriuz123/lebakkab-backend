<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Main Menu
        $mainMenu = Menu::create([
            'title' => 'Beranda',
            'menu_type' => 'main',
            'link_type' => 'halaman_statis',
            'link_ref' => '1', // misal ID halaman_statis beranda
            'sort_order' => 1,
        ]);

        $profilMenu = Menu::create([
            'title' => 'Profil',
            'menu_type' => 'main',
            'link_type' => 'halaman_statis',
            'link_ref' => '2',
            'sort_order' => 2,
        ]);

        Menu::create([
            'title' => 'Sejarah',
            'menu_type' => 'main',
            'parent_id' => $profilMenu->id,
            'link_type' => 'halaman_statis',
            'link_ref' => '3',
            'sort_order' => 1,
        ]);

        Menu::create([
            'title' => 'Visi & Misi',
            'menu_type' => 'main',
            'parent_id' => $profilMenu->id,
            'link_type' => 'halaman_statis',
            'link_ref' => '4',
            'sort_order' => 2,
        ]);

        // Front Menu
        Menu::create([
            'title' => 'Layanan Publik',
            'menu_type' => 'front',
            'link_type' => 'modul',
            'link_ref' => 'data_aplikasis',
            'sort_order' => 1,
        ]);

        Menu::create([
            'title' => 'Agenda',
            'menu_type' => 'front',
            'link_type' => 'modul',
            'link_ref' => 'agendas',
            'sort_order' => 2,
        ]);

        // Footer Menu
        Menu::create([
            'title' => 'Kontak Kami',
            'menu_type' => 'footer',
            'link_type' => 'halaman_statis',
            'link_ref' => '5', // misal halaman kontak
            'sort_order' => 1,
        ]);

        Menu::create([
            'title' => 'Website OPD',
            'menu_type' => 'footer',
            'link_type' => 'eksternal',
            'url' => 'https://opd.lebakkab.go.id',
            'sort_order' => 2,
        ]);
    }
}
