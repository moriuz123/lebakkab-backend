<?php

namespace App\Filament\Resources\PengumumanResource\Pages;

use App\Filament\Resources\PengumumanResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction; // ✅ Gunakan namespace baru sesuai Filament v3

class ListPengumumen extends ListRecords
{
    /**
     * Resource yang digunakan
     */
    protected static string $resource = PengumumanResource::class;

    /**
     * Tombol-tombol aksi pada halaman list
     */
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make() // ✅ Action tombol "Tambah" / "Create"
                ->icon('heroicon-o-plus')
                ->label('Tambah Pengumuman')
                ->color('success'),
        ];
    }

    public function getTitle(): string
    {
        return 'Data Pengumuman';
    }
}
