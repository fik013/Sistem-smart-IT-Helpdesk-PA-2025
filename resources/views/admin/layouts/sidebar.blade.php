<aside class="flex w-64 flex-col justify-between bg-[#111822] border-r border-[#233348] p-4 hidden md:flex flex-none">
    <div class="flex flex-col gap-4">
        <div class="flex flex-col px-3 pb-2">
            <h1 class="text-white text-base font-medium leading-normal">Admin Panel</h1>
            <p class="text-[#92a9c9] text-sm font-normal leading-normal">IT Support System</p>
        </div>
        <div class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined group-hover:text-white transition-colors">dashboard</span>
                <p class="text-sm font-medium leading-normal">Dashboard</p>
            </a>
            <!-- Tickets Link -->
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.tickets.*') ? 'bg-primary/20 text-white border border-primary/20' : 'text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group' }}" href="{{ route('admin.tickets.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.tickets.*') ? 'text-primary fill-1' : 'group-hover:text-white transition-colors' }}">confirmation_number</span>
                <p class="text-sm font-medium leading-normal">Kelola Tiket</p>
            </a>
            
            <!-- Inventory Link -->
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.inventory.*') ? 'bg-primary/20 text-white border border-primary/20' : 'text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group' }}" href="{{ route('admin.inventory.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.inventory.*') ? 'text-primary fill-1' : 'group-hover:text-white transition-colors' }}">inventory_2</span>
                <p class="text-sm font-medium leading-normal">Asset Management</p>
            </a>
            <!-- Active State Check -->
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-primary/20 text-white border border-primary/20' : 'text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group' }}" href="{{ route('admin.users.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.users.*') ? 'text-primary fill-1' : 'group-hover:text-white transition-colors' }}">group</span>
                <p class="text-sm font-medium leading-normal">Kelola Akun</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.faq.*') ? 'bg-primary/20 text-white border border-primary/20' : 'text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group' }}" href="{{ route('admin.faq.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.faq.*') ? 'text-primary fill-1' : 'group-hover:text-white transition-colors' }}">help</span>
                <p class="text-sm font-medium leading-normal">Kelola FAQ</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-primary/20 text-white border border-primary/20' : 'text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group' }}" href="{{ route('admin.reports.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.reports.*') ? 'text-primary fill-1' : 'group-hover:text-white transition-colors' }}">pie_chart</span>
                <p class="text-sm font-medium leading-normal">Reports</p>
            </a>
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.prioritas.index') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group' }}">
                <a href="{{ route('admin.prioritas.index') }}" class="flex items-center gap-3 w-full">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.prioritas.index') ? 'icon-fill' : 'group-hover:text-primary transition-colors' }}">filter_list</span>
                    <p class="text-sm font-medium leading-normal">Prioritas SAW</p>
                </a>
            </div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group" href="#">
                <span class="material-symbols-outlined group-hover:text-white transition-colors">tune</span>
                <p class="text-sm font-medium leading-normal">Settings</p>
            </a>
        </div>
    </div>
    <div class="px-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 px-3 py-2 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors">
                <span class="material-symbols-outlined">logout</span>
                <p class="text-sm font-medium leading-normal">Logout</p>
            </button>
        </form>
    </div>
</aside>
