<!DOCTYPE html>
<html class="dark" lang="id" x-data="{ 
    darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
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
