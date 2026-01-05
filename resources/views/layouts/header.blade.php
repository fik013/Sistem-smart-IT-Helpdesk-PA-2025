<header class="flex flex-col whitespace-nowrap border-b border-solid border-b-slate-200 dark:border-b-[#233348] bg-white/90 dark:bg-[#111822]/90 backdrop-blur-md px-6 lg:px-10 py-3" x-data="{ mobileMenuOpen: false }">
    <div class="flex items-center justify-between w-full">
        <div class="flex items-center gap-4 lg:gap-8">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-slate-900 dark:text-white hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-3xl">menu</span>
            </button>
            <div class="flex items-center gap-3 text-primary dark:text-white">
                <span class="material-symbols-outlined text-3xl text-primary">support_agent</span>
                <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] hidden sm:block">Smart IT Helpdesk</h2>
            </div>
            <!-- Global Search -->
            <div class="hidden md:flex flex-col min-w-40 max-w-64 relative" x-data="{
                searchQuery: '',
                searchResults: [],
                links: [
                    { title: 'Dashboard', url: '{{ route('user.dashboard') }}', icon: 'dashboard' },
                    { title: 'FAQ & Panduan', url: '{{ route('user.faq') }}', icon: 'quiz' },
                    { title: 'Tiket Saya', url: '{{ route('tickets.index') }}', icon: 'confirmation_number' },
                    { title: 'Buat Tiket Baru', url: '{{ route('tickets.create') }}', icon: 'add_circle' },
                    { title: 'Inventaris Saya', url: '{{ route('user.inventory') }}', icon: 'devices' },
                    { title: 'Logout/Keluar', url: '#', icon: 'logout', action: 'submitLogout' }
                ],
                performSearch() {
                    if (this.searchQuery.length < 2) {
                        this.searchResults = [];
                        return;
                    }
                    const q = this.searchQuery.toLowerCase();
                    this.searchResults = this.links.filter(link => link.title.toLowerCase().includes(q));
                },
                submitLogout() {
                    document.getElementById('logout-form-header').submit();
                }
            }" @click.away="searchResults = []">
                <div class="flex w-full flex-1 items-stretch rounded-lg h-10">
                    <div class="text-slate-400 dark:text-[#92a9c9] flex border-none bg-slate-100 dark:bg-[#233348] items-center justify-center pl-4 rounded-l-lg border-r-0">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </div>
                    <input x-model="searchQuery" @input="performSearch()" @focus="performSearch()" 
                           class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-white focus:outline-0 focus:ring-0 border-none bg-slate-100 dark:bg-[#233348] focus:border-none h-full placeholder:text-slate-400 dark:placeholder:text-[#92a9c9] px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal" 
                           placeholder="Cari menu (ex: Tiket, FAQ)..." />
                </div>
                
                <!-- Search Results Dropdown -->
                <div x-show="searchResults.length > 0" class="absolute top-12 left-0 w-full bg-white dark:bg-[#192433] rounded-lg shadow-xl border border-slate-100 dark:border-[#324867] overflow-hidden z-[60]" style="display: none;">
                    <template x-for="result in searchResults">
                        <a :href="result.url" 
                           @click.prevent="result.action ? $data[result.action]() : window.location.href = result.url"
                           class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 dark:hover:bg-[#233348] transition-colors cursor-pointer group">
                            <span class="material-symbols-outlined text-slate-400 group-hover:text-primary text-[20px]" x-text="result.icon"></span>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-200 group-hover:text-primary" x-text="result.title"></span>
                        </a>
                    </template>
                </div>
            </div>
        </div>
        <div class="flex flex-1 justify-end gap-4 lg:gap-8" x-data="{ open: false }">
            <!-- Theme Toggle -->
            <button @click="toggleTheme()" class="flex items-center justify-center rounded-lg h-10 w-10 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#233348] transition-colors">
                <span class="material-symbols-outlined text-[20px]" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
            </button>
            <div class="hidden lg:flex items-center gap-6">
                <a class="{{ request()->routeIs('user.dashboard') ? 'text-slate-900 dark:text-white text-sm font-bold leading-normal border-b-2 border-primary' : 'text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary dark:hover:text-white transition-colors' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="{{ request()->routeIs('user.faq') ? 'text-slate-900 dark:text-white text-sm font-bold leading-normal border-b-2 border-primary' : 'text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary dark:hover:text-white transition-colors' }}" href="{{ route('user.faq') }}">FAQ</a>
                <a class="{{ request()->routeIs('tickets.*') ? 'text-slate-900 dark:text-white text-sm font-bold leading-normal border-b-2 border-primary' : 'text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary dark:hover:text-white transition-colors' }}" href="{{ route('tickets.index') }}">Tiket Saya</a>
                <a class="{{ request()->routeIs('user.inventory') ? 'text-slate-900 dark:text-white text-sm font-bold leading-normal border-b-2 border-primary' : 'text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary dark:hover:text-white transition-colors' }}" href="{{ route('user.inventory') }}">Inventaris</a>
            </div>
            <div class="relative" x-data="{ notifOpen: false }">
                <button @click="notifOpen = !notifOpen" class="relative flex items-center justify-center overflow-hidden rounded-lg h-10 w-10 bg-slate-100 dark:bg-[#233348] text-slate-900 dark:text-white hover:bg-slate-200 dark:hover:bg-[#324867] transition-colors">
                    <span class="material-symbols-outlined text-[20px]">notifications</span>
                    @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                        <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 animate-pulse"></span>
                    @endif
                </button>
                
                <div x-show="notifOpen" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.away="notifOpen = false"
                     class="absolute right-0 mt-2 w-80 bg-white dark:bg-[#192433] rounded-xl shadow-xl border border-slate-100 dark:border-[#324867] overflow-hidden z-[60]" 
                     style="display: none;">
                    
                    <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 dark:border-[#324867]">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Notifikasi</h3>
                        @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.readAll') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-primary hover:text-blue-600 font-medium transition-colors">Tandai dibaca</button>
                            </form>
                        @endif
                    </div>

                    <div class="max-h-[400px] overflow-y-auto">
                        @if(auth()->check())
                        
                        <!-- Unread Notifications -->
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <div class="px-4 py-2 bg-slate-50 dark:bg-[#1f2937] border-b border-slate-100 dark:border-[#324867]">
                                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Belum Dibaca</p>
                            </div>
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="block px-4 py-3 hover:bg-slate-50 dark:hover:bg-[#233348] transition-colors border-b border-slate-50 dark:border-[#324867] last:border-0 group bg-white dark:bg-[#192433]">
                                    <div class="flex gap-3">
                                        <div class="flex-shrink-0 mt-1">
                                             @if(($notification->data['type'] ?? '') == 'ticket_created')
                                                <span class="material-symbols-outlined text-green-500 text-[20px]">check_circle</span>
                                             @elseif(($notification->data['type'] ?? '') == 'ticket_status_updated')
                                                <span class="material-symbols-outlined text-blue-500 text-[20px]">update</span>
                                             @elseif(($notification->data['type'] ?? '') == 'announcement')
                                                <span class="material-symbols-outlined text-yellow-500 text-[20px]">campaign</span>
                                             @else
                                                <span class="material-symbols-outlined text-primary text-[20px]">notifications</span>
                                             @endif
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-slate-800 dark:text-slate-200 group-hover:text-primary transition-colors">{{ $notification->data['title'] ?? 'Notifikasi Baru' }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-2">{{ $notification->data['message'] ?? '' }}</p>
                                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1.5">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="flex-shrink-0 self-center">
                                            <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        <!-- Read Notifications -->
                        @if(auth()->user()->readNotifications->count() > 0)
                            <div class="px-4 py-2 bg-slate-50 dark:bg-[#1f2937] border-b border-slate-100 dark:border-[#324867] {{ auth()->user()->unreadNotifications->count() > 0 ? 'border-t' : '' }}">
                                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Sudah Dibaca</p>
                            </div>
                            @foreach(auth()->user()->readNotifications->take(5) as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}" class="block px-4 py-3 hover:bg-slate-50 dark:hover:bg-[#233348] transition-colors border-b border-slate-50 dark:border-[#324867] last:border-0 group opacity-75 grayscale-[0.3]">
                                    <div class="flex gap-3">
                                        <div class="flex-shrink-0 mt-1">
                                             @if(($notification->data['type'] ?? '') == 'ticket_created')
                                                <span class="material-symbols-outlined text-slate-400 text-[20px]">check_circle</span>
                                             @elseif(($notification->data['type'] ?? '') == 'ticket_status_updated')
                                                <span class="material-symbols-outlined text-slate-400 text-[20px]">update</span>
                                             @elseif(($notification->data['type'] ?? '') == 'announcement')
                                                <span class="material-symbols-outlined text-slate-400 text-[20px]">campaign</span>
                                             @else
                                                <span class="material-symbols-outlined text-slate-400 text-[20px]">notifications</span>
                                             @endif
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $notification->data['title'] ?? 'Notifikasi' }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-500 mt-0.5 line-clamp-2">{{ $notification->data['message'] ?? '' }}</p>
                                            <p class="text-[10px] text-slate-400 mt-1.5">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        @if(auth()->user()->notifications->count() == 0)
                            <div class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">
                                <span class="material-symbols-outlined text-3xl mb-2 opacity-50">notifications_off</span>
                                <p class="text-xs">Tidak ada notifikasi.</p>
                            </div>
                        @endif
                        
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- User Dropdown -->
            <div class="relative">
                <div @click="open = !open" @click.away="open = false" class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 cursor-pointer border-2 border-transparent hover:border-primary transition-all" 
                     style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}");'>
                </div>
                <!-- Dropdown Menu -->
                <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#192433] rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                        <p class="text-sm text-gray-700 dark:text-white font-bold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Kelola Profile
                    </a>
                    <div class="border-t border-gray-100 dark:border-gray-700"></div>                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form-header" flexaction="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-collapse class="lg:hidden w-full border-t border-slate-100 dark:border-[#233348] mt-4 pt-4 pb-2 flex flex-col gap-4" style="display: none;">
        <a class="px-2 py-2 {{ request()->routeIs('user.dashboard') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-300' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
        <a class="px-2 py-2 {{ request()->routeIs('user.faq') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-300' }}" href="{{ route('user.faq') }}">FAQ</a>
        <a class="px-2 py-2 {{ request()->routeIs('tickets.*') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-300' }}" href="{{ route('tickets.index') }}">Tiket Saya</a>
        <a class="px-2 py-2 {{ request()->routeIs('user.inventory') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-300' }}" href="{{ route('user.inventory') }}">Inventaris</a>
    </div>
</header>
