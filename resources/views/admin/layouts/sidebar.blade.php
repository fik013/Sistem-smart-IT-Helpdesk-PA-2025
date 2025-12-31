<aside class="flex w-64 flex-col justify-between bg-white dark:bg-[#111822] border-r border-slate-200 dark:border-[#233348] p-4 hidden md:flex flex-none transition-colors duration-200">
    <div class="flex flex-col gap-4">
        <div class="flex flex-col px-3 pb-2">
            <h1 class="text-[#101822] dark:text-white text-base font-medium leading-normal">Admin Panel</h1>
            <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-normal leading-normal">IT Support System</p>
        </div>
        <div class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">dashboard</span>
                <p class="text-sm font-medium leading-normal">Dashboard</p>
            </a>
            <!-- Tickets Link -->
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.tickets.*') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.tickets.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.tickets.*') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">confirmation_number</span>
                <p class="text-sm font-medium leading-normal">Kelola Tiket</p>
            </a>
            
            <!-- Inventory Link -->
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.inventory.*') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.inventory.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.inventory.*') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">inventory_2</span>
                <p class="text-sm font-medium leading-normal">Asset Management</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.asset-categories.*') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.asset-categories.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.asset-categories.*') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">category</span>
                <p class="text-sm font-medium leading-normal">Kategori Aset</p>
            </a>
            <!-- Active State Check -->
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.users.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.users.*') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">group</span>
                <p class="text-sm font-medium leading-normal">Kelola Akun</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.departments.*') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.departments.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.departments.*') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">work</span>
                <p class="text-sm font-medium leading-normal">Kelola Jabatan</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.faq.*') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.faq.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.faq.*') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">help</span>
                <p class="text-sm font-medium leading-normal">Kelola FAQ</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.reports.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.reports.*') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">pie_chart</span>
                <p class="text-sm font-medium leading-normal">Reports</p>
            </a>
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.prioritas.index') ? 'bg-primary/10 dark:bg-primary/10 text-primary border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}">
                <a href="{{ route('admin.prioritas.index') }}" class="flex items-center gap-3 w-full">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.prioritas.index') ? 'icon-fill' : 'group-hover:text-primary transition-colors' }}">filter_list</span>
                    <p class="text-sm font-medium leading-normal">Prioritas SAW</p>
                </a>
            </div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.announcements.*') ? 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-white border border-primary/20' : 'text-slate-500 dark:text-[#92a9c9] hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-[#101822] dark:hover:text-white transition-colors group' }}" href="{{ route('admin.announcements.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.announcements.*') ? 'text-primary fill-1' : 'group-hover:text-[#101822] dark:group-hover:text-white transition-colors' }}">campaign</span>
                <p class="text-sm font-medium leading-normal">Kelola Pengumuman</p>
            </a>
        </div>
    </div>
    <div class="px-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 px-3 py-2 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors">
                <span class="material-symbols-outlined">logout</span>
                <p class="text-sm font-medium leading-normal">Logout</p>
            </button>
        </form>
    </div>
</aside>
