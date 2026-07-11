<div class="space-y-6 p-1">
    <div class="text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700">
        💡 <strong>Tips:</strong> Klik kotak icon di bawah ini untuk menyalin <em>class</em>-nya.
    </div>

    <!-- Heroicons -->
    <div>
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-sm font-bold flex items-center gap-1.5 text-gray-800 dark:text-gray-200">
                <x-icon name="heroicon-o-check-badge" class="w-4 h-4 text-primary-500" />
                Heroicons
            </h3>
            <a href="https://heroicons.com/" target="_blank" class="text-[10px] bg-primary-50 dark:bg-primary-500/10 text-primary-600 dark:text-primary-400 px-2 py-1 rounded hover:bg-primary-100 dark:hover:bg-primary-500/20 transition" style="text-decoration: none;">
                🌐 Lihat Semua Heroicons &rarr;
            </a>
        </div>
        <!-- Layout CSS Grid Murni (Kotak-Kotak Kecil) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(75px, 1fr)); gap: 8px;">
            @php
                $heroicons = [
                    'heroicon-o-home', 'heroicon-o-information-circle', 'heroicon-o-phone', 
                    'heroicon-o-envelope', 'heroicon-o-users', 'heroicon-o-building-office', 
                    'heroicon-o-building-library', 'heroicon-o-map-pin', 'heroicon-o-calendar-days', 
                    'heroicon-o-newspaper', 'heroicon-o-document-text', 'heroicon-o-photo', 
                    'heroicon-o-video-camera', 'heroicon-o-link', 'heroicon-o-cog-6-tooth',
                    'heroicon-o-megaphone', 'heroicon-o-briefcase', 'heroicon-o-academic-cap',
                    'heroicon-o-globe-alt', 'heroicon-o-shopping-cart', 'heroicon-o-truck',
                    'heroicon-o-ticket', 'heroicon-o-tag', 'heroicon-o-bell'
                ];
            @endphp
            @foreach($heroicons as $icon)
                <button type="button" onclick="copyIconClass('{{ $icon }}')" class="flex flex-col items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 hover:bg-primary-50 dark:hover:bg-primary-500/10 hover:border-primary-500 transition-all focus:ring-2 focus:ring-primary-500 group shadow-sm" title="{{ $icon }}" style="aspect-ratio: 1/1; padding: 4px;">
                    <x-icon name="{{ $icon }}" class="w-6 h-6 text-gray-600 dark:text-gray-400 group-hover:text-primary-500 transition-colors" style="width: 24px; height: 24px;" />
                    <span class="text-[9px] mt-1.5 text-gray-500 dark:text-gray-400 w-full text-center group-hover:text-primary-600 dark:group-hover:text-primary-400" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding: 0 4px;">
                        {{ str_replace('heroicon-o-', '', $icon) }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Lucide Icons -->
    <div style="margin-top: 24px;">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-sm font-bold flex items-center gap-1.5 text-gray-800 dark:text-gray-200">
                <x-icon name="heroicon-o-sparkles" class="w-4 h-4 text-primary-500" />
                Lucide Icons
            </h3>
            <a href="https://lucide.dev/icons/" target="_blank" class="text-[10px] bg-primary-50 dark:bg-primary-500/10 text-primary-600 dark:text-primary-400 px-2 py-1 rounded hover:bg-primary-100 dark:hover:bg-primary-500/20 transition" style="text-decoration: none;">
                🌐 Lihat Semua Lucide &rarr;
            </a>
        </div>
        <!-- Layout CSS Grid Murni (Kotak-Kotak Kecil) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(75px, 1fr)); gap: 8px;">
            @php
                $lucideIcons = [
                    'home', 'info', 'phone', 'mail', 'users', 'landmark', 
                    'map-pin', 'calendar', 'newspaper', 'file-text', 'image', 
                    'video', 'link', 'settings', 'megaphone', 'briefcase', 
                    'graduation-cap', 'globe', 'shopping-bag', 'truck',
                    'ticket', 'tag', 'bell', 'gavel'
                ];
            @endphp
            @foreach($lucideIcons as $icon)
                @php $className = 'lucide-' . $icon; @endphp
                <button type="button" onclick="copyIconClass('{{ $className }}')" class="flex flex-col items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all focus:ring-2 focus:ring-primary-500 group shadow-sm" title="{{ $className }}" style="aspect-ratio: 1/1; padding: 4px;">
                    <img src="https://unpkg.com/lucide-static@latest/icons/{{ $icon }}.svg" class="w-6 h-6 opacity-60 dark:invert dark:opacity-70 group-hover:opacity-100 transition-opacity" alt="{{ $icon }}" style="width: 24px; height: 24px;" />
                    <span class="text-[9px] mt-1.5 text-gray-500 dark:text-gray-400 w-full text-center group-hover:text-gray-800 dark:group-hover:text-gray-200" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding: 0 4px;">
                        {{ $icon }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>
</div>

<script>
    window.copyIconClass = function(text) {
        navigator.clipboard.writeText(text).then(() => {
            if (typeof window.FilamentNotification !== 'undefined') {
                new window.FilamentNotification().title('Tersalin!').body(text).success().send();
            } else {
                alert('Tersalin: ' + text);
            }
        });
    }
</script>