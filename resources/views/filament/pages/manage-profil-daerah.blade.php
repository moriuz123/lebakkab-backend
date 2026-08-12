<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <div class="mt-4 text-right">
            <x-filament::button type="submit" class="bg-primary-600 hover:bg-primary-500">
                Simpan Profil Daerah
            </x-filament::button>
        </div>
    </x-filament-panels::form>
</x-filament-panels::page>
