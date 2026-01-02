<header class="sticky top-0 z-50 flex flex-col whitespace-nowrap border-b border-solid border-b-slate-200 dark:border-b-[#233348] bg-white/90 dark:bg-[#111822]/90 backdrop-blur-md px-6 lg:px-10 py-3" x-data="{ mobileMenuOpen: false }">
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
            <label class="hidden md:flex flex-col min-w-40 !h-10 max-w-64">
                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                    <div class="text-slate-400 dark:text-[#92a9c9] flex border-none bg-slate-100 dark:bg-[#233348] items-center justify-center pl-4 rounded-l-lg border-r-0">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </div>
                    <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-white focus:outline-0 focus:ring-0 border-none bg-slate-100 dark:bg-[#233348] focus:border-none h-full placeholder:text-slate-400 dark:placeholder:text-[#92a9c9] px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal" placeholder="Cari tiket atau artikel..." value=""/>
                </div>
            </label>
        </div>
        <div class="flex flex-1 justify-end gap-4 lg:gap-8" x-data="{ open: false }">
            <div class="hidden lg:flex items-center gap-6">
                <a class="{{ request()->routeIs('user.dashboard') ? 'text-slate-900 dark:text-white text-sm font-bold leading-normal border-b-2 border-primary' : 'text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary dark:hover:text-white transition-colors' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="{{ request()->routeIs('user.faq') ? 'text-slate-900 dark:text-white text-sm font-bold leading-normal border-b-2 border-primary' : 'text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary dark:hover:text-white transition-colors' }}" href="{{ route('user.faq') }}">FAQ</a>
                <a class="{{ request()->routeIs('tickets.*') ? 'text-slate-900 dark:text-white text-sm font-bold leading-normal border-b-2 border-primary' : 'text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary dark:hover:text-white transition-colors' }}" href="{{ route('tickets.index') }}">Tiket Saya</a>
                <a class="{{ request()->routeIs('user.inventory') ? 'text-slate-900 dark:text-white text-sm font-bold leading-normal border-b-2 border-primary' : 'text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary dark:hover:text-white transition-colors' }}" href="{{ route('user.inventory') }}">Inventaris</a>
            </div>
            <button class="relative flex items-center justify-center overflow-hidden rounded-lg h-10 w-10 bg-slate-100 dark:bg-[#233348] text-slate-900 dark:text-white hover:bg-slate-200 dark:hover:bg-[#324867] transition-colors">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
                <!-- Badge Notification logic could go here -->
                <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500"></span>
            </button>
            
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-collapse class="lg:hidden w-full border-t border-slate-100 dark:border-[#233348] mt-4 pt-4 pb-2 flex flex-col gap-4" style="display: none;">
        <a class="px-2 py-2 {{ request()->routeIs('user.dashboard') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-300' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
        <a class="px-2 py-2 {{ request()->routeIs('user.faq') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-300' }}" href="{{ route('user.faq') }}">FAQ</a>
        <a class="px-2 py-2 {{ request()->routeIs('tickets.*') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-300' }}" href="{{ route('tickets.index') }}">Tiket Saya</a>
        <a class="px-2 py-2 {{ request()->routeIs('user.inventory') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-300' }}" href="{{ route('user.inventory') }}">Inventaris</a>
    </div>
</header>
