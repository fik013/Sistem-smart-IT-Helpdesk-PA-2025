<!DOCTYPE html>
<html lang="id" x-data="{ 
    darkMode: localStorage.getItem('theme') === 'dark',
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" x-init="$watch('darkMode', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')); if(darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Smart IT Helpdesk') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS with Plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
             const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
             if (token) {
                 axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
                 axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
             }
        });
    </script>
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
                        "surface-dark": "#1e293b", 
                        "surface-light": "#ffffff",
                        "surface-border": "#233348",
                        "border-dark": "#233348",
                        "card-dark": "#1A2634",
                        "text-secondary": "#92a9c9",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem", 
                        "lg": "0.5rem", 
                        "xl": "0.75rem", 
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24
        }
        /* Custom scrollbar for dark mode feel */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #101822; }
        ::-webkit-scrollbar-thumb { background: #233348; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #324867; }
        
        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-white min-h-screen flex flex-col overflow-x-hidden">
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
        <div id="page-loader" class="fixed inset-0 z-[9999] bg-background-light dark:bg-background-dark flex items-center justify-center transition-opacity duration-500 ease-in-out">
            <div class="flex flex-col items-center gap-3 animate-bounce">
                <div class="size-20 bg-primary/10 rounded-full flex items-center justify-center text-primary shadow-lg shadow-primary/20 ring-4 ring-primary/5">
                    <span class="material-symbols-outlined text-5xl">support_agent</span>
                </div>
                <div class="flex flex-col items-center">
                    <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Smart IT Helpdesk</h1>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Memuat...</p>
                </div>
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
    @endif
    <!-- Top Navigation Bar -->
    <div class="order-first z-50 sticky top-0">
        @include('layouts.header')
    </div>

    <!-- Main Content -->
    <main class="flex-1 layout-container flex flex-col w-full max-w-[1280px] mx-auto px-4 md:px-10 py-6 md:py-8 gap-8">
        @yield('content')
    </main>

    <!-- Simple Footer -->
    <footer class="border-t border-slate-200 dark:border-[#233348] mt-8 py-6 bg-white dark:bg-[#111822]">
        <div class="layout-container max-w-[1280px] mx-auto px-4 md:px-10 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-500 dark:text-[#92a9c9]">
            <p>© {{ date('Y') }} Smart IT Helpdesk. Hak Cipta Dilindungi.</p>
            <div class="flex gap-4">
                <a class="hover:text-primary" href="#">Kebijakan Privasi</a>
                <a class="hover:text-primary" href="#">Syarat Layanan</a>
                <a class="hover:text-primary" href="#">Bantuan</a>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
