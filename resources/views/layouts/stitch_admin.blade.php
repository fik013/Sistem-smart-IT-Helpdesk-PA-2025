<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Smart IT Helpdesk - Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Fonts: Inter -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#136dec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101822",
                        "component-dark": "#111822",
                        "element-dark": "#233348",
                        "text-secondary": "#92a9c9",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #111822; }
        ::-webkit-scrollbar-thumb { background: #233348; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #324867; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-white overflow-hidden">
<!-- Page Transition Loader -->
@if(session('login_success'))
<div id="page-loader" class="fixed inset-0 z-[9999] bg-background-light dark:bg-background-dark flex flex-col items-center justify-center transition-opacity duration-700 ease-in-out">
    
    <!-- Assembly Animation Container -->
    <div class="relative size-32 flex items-center justify-center">
        <!-- Corner Shapes (Uniting Animation) -->
        <div class="absolute top-0 left-0 w-8 h-8 border-t-4 border-l-4 border-primary rounded-tl-xl opacity-0 animate-assemble-tl"></div>
        <div class="absolute top-0 right-0 w-8 h-8 border-t-4 border-r-4 border-primary rounded-tr-xl opacity-0 animate-assemble-tr"></div>
        <div class="absolute bottom-0 left-0 w-8 h-8 border-b-4 border-l-4 border-primary rounded-bl-xl opacity-0 animate-assemble-bl"></div>
        <div class="absolute bottom-0 right-0 w-8 h-8 border-b-4 border-r-4 border-primary rounded-br-xl opacity-0 animate-assemble-br"></div>
        
        <!-- Center Icon (Appears after assembly) -->
        <div class="absolute inset-0 flex items-center justify-center opacity-0 animate-icon-reveal">
            <div class="size-20 bg-primary/10 rounded-full flex items-center justify-center text-primary shadow-lg shadow-primary/20 ring-1 ring-primary/20">
                <span class="material-symbols-outlined text-5xl animate-pulse">support_agent</span>
            </div>
        </div>
    </div>

    <!-- Text Animation -->
    <div class="mt-8 flex flex-col items-center opacity-0 animate-text-reveal">
        <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Smart IT Helpdesk</h1>
        <div class="flex items-center gap-1 mt-2">
            <div class="w-2 h-2 rounded-full bg-primary animate-bounce"></div>
            <div class="w-2 h-2 rounded-full bg-primary animate-bounce delay-75"></div>
            <div class="w-2 h-2 rounded-full bg-primary animate-bounce delay-150"></div>
        </div>
    </div>
    <!-- Styles for Loader Animation -->
    <style>
        @keyframes assemble-tl { 0% { transform: translate(-40px, -40px); opacity: 0; } 50% { opacity: 1; } 100% { transform: translate(16px, 16px); opacity: 1; } }
        @keyframes assemble-tr { 0% { transform: translate(40px, -40px); opacity: 0; } 50% { opacity: 1; } 100% { transform: translate(-16px, 16px); opacity: 1; } }
        @keyframes assemble-bl { 0% { transform: translate(-40px, 40px); opacity: 0; } 50% { opacity: 1; } 100% { transform: translate(16px, -16px); opacity: 1; } }
        @keyframes assemble-br { 0% { transform: translate(40px, 40px); opacity: 0; } 50% { opacity: 1; } 100% { transform: translate(-16px, -16px); opacity: 1; } }
        @keyframes icon-reveal { 0% { transform: scale(0.5); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
        @keyframes text-reveal { 0% { transform: translateY(10px); opacity: 0; } 100% { transform: translateY(0); opacity: 1; } }
        .animate-assemble-tl { animation: assemble-tl 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-assemble-tr { animation: assemble-tr 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-assemble-bl { animation: assemble-bl 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-assemble-br { animation: assemble-br 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-icon-reveal { animation: icon-reveal 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.6s forwards; }
        .animate-text-reveal { animation: text-reveal 0.5s ease-out 0.8s forwards; }
        .delay-75 { animation-delay: 75ms; }
        .delay-150 { animation-delay: 150ms; }
    </style>
    <script>
        window.addEventListener('load', function() {
            setTimeout(() => {
                const loader = document.getElementById('page-loader');
                if (loader) {
                    loader.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => { loader.remove(); }, 700);
                }
            }, 1800);
        });
    </script>
</div>
@else
<!-- Simple Bounce Loader for Regular Navigation -->
<div id="page-loader" class="fixed inset-0 z-[9999] bg-background-light dark:bg-background-dark flex flex-col items-center justify-center transition-opacity duration-500 ease-in-out">
    <div class="flex flex-col items-center gap-3 animate-bounce">
        <div class="size-20 bg-primary/10 rounded-full flex items-center justify-center text-primary shadow-lg shadow-primary/20 ring-4 ring-primary/5">
            <span class="material-symbols-outlined text-5xl">support_agent</span>
        </div>
        <div class="flex flex-col items-center">
            <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Smart IT Helpdesk</h1>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Memuat...</p>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            setTimeout(() => {
                const loader = document.getElementById('page-loader');
                if (loader) {
                    loader.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => { loader.remove(); }, 500);
                }
            }, 800);
        });
    </script>
</div>
@endif
<div class="flex h-screen w-full flex-col overflow-hidden">
    <!-- TopNavBar -->
    <header class="flex flex-none items-center justify-between whitespace-nowrap border-b border-solid border-b-[#233348] bg-[#111822] px-10 py-3 z-20">
        <div class="flex items-center gap-4 text-white">
            <div class="size-8 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined" style="font-size: 32px;">dns</span>
            </div>
            <h2 class="text-white text-lg font-bold leading-tight tracking-[-0.015em]">Smart IT Helpdesk</h2>
        </div>
        <div class="flex flex-1 justify-end gap-8" x-data="{ open: false }">
            <div class="flex gap-2">
                <button class="flex size-10 cursor-pointer items-center justify-center rounded-lg bg-[#233348] text-white hover:bg-[#324867] transition-colors">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
            </div>
            
            <!-- User Dropdown -->
            <div class="relative">
                <div @click="open = !open" @click.away="open = false" class="bg-center bg-no-repeat bg-cover rounded-full size-10 border border-[#233348] cursor-pointer" style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}");'></div>
                
                <!-- Dropdown Menu -->
                <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#192433] rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                        <p class="text-sm text-gray-700 dark:text-white font-bold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="flex flex-1 overflow-hidden">
        <!-- SideNavBar -->
        <aside class="flex w-64 flex-col justify-between bg-[#111822] border-r border-[#233348] p-4 hidden md:flex flex-none">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col px-3 pb-2">
                    <h1 class="text-white text-base font-medium leading-normal">Admin Panel</h1>
                    <p class="text-[#92a9c9] text-sm font-normal leading-normal">IT Support System</p>
                </div>
                <div class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary/20 text-white border border-primary/20' : 'text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors' }}" href="{{ route('admin.dashboard') }}">
                        <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'text-primary fill-1' : '' }}">dashboard</span>
                        <p class="text-sm font-medium leading-normal">Dashboard</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group" href="#">
                        <span class="material-symbols-outlined group-hover:text-white transition-colors">confirmation_number</span>
                        <p class="text-sm font-medium leading-normal">Tickets</p>
                    </a>
                    <!-- Placeholder for Manage Accounts if I create it -->
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#92a9c9] hover:bg-[#233348] hover:text-white transition-colors group" href="#">
                        <span class="material-symbols-outlined group-hover:text-white transition-colors">group</span>
                        <p class="text-sm font-medium leading-normal">Kelola Akun</p>
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
        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto bg-[#111822]">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
