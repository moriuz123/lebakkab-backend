<IconPreview />
<div class="space-y-10 max-h-[600px] overflow-y-auto p-6">
    <!-- 🔹 Lucide Icons -->
    <div>

        <h3 class="text-lg font-semibold mb-4">Lucide Icons</h3>
        <div class="grid grid-cols-6 gap-6 text-center">
            <div>
                <i data-lucide="home" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs block mt-1">lucide-home</span>
            </div>
            <div>
                <i data-lucide="user" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs block mt-1">lucide-user</span>
            </div>
            <div>
                <i data-lucide="settings" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs block mt-1">lucide-settings</span>
            </div>
            <div>
                <i data-lucide="bell" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs block mt-1">lucide-bell</span>
            </div>
            <div>
                <i data-lucide="search" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs block mt-1">lucide-search</span>
            </div>
            <div>
                <i data-lucide="calendar" class="w-8 h-8 mx-auto"></i>
                <span class="text-xs block mt-1">lucide-calendar</span>
            </div>
        </div>
    </div>

    <!-- 🔹 Heroicons -->
    <div>
        <h3 class="text-lg font-semibold mb-4">Hero Icons</h3>
        <div class="grid grid-cols-6 gap-6 text-center">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 0h8" />
                </svg>
                <span class="text-xs block mt-1">hero-home</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A3.5 3.5 0 1112 15.5a3.5 3.5 0 01-6.879 2.304z" />
                </svg>
                <span class="text-xs block mt-1">heroicon-o-megaphone</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                </svg>
                <span class="text-xs block mt-1">hero-clock</span>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons(); // 🔹 render semua icon lucide
</script>