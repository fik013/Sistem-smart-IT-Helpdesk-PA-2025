<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ 
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
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
                            "background-dark": "#111822",
                            "surface-dark": "#192433",
                            "border-dark": "#324867",
                            "text-secondary": "#92a9c9",
                        },
                        fontFamily: {
                            "display": ["Inter", "sans-serif"]
                        },
                    },
                },
            }
        </script>
    </head>
    <body class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-white antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            
            <!-- Abstract Background Decoration -->
            <div class="absolute inset-0 z-0 pointer-events-none opacity-20 dark:opacity-40">
                <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-primary rounded-full blur-[120px] opacity-20"></div>
                <div class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-purple-500 rounded-full blur-[120px] opacity-20"></div>
            </div>

            <!-- Theme Toggle Absolute -->
            <button @click="toggleTheme()" class="absolute top-4 right-4 z-50 p-2 rounded-full bg-white dark:bg-surface-dark shadow-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-[#233348] transition-colors">
                 <span class="material-symbols-outlined text-[20px]" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
            </button>

            <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-surface-dark shadow-2xl border border-gray-200 dark:border-border-dark sm:rounded-xl overflow-hidden">
                 <div class="flex justify-center mb-6">
                    <a href="/">
                        <div class="size-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                             <!-- Simple Logo Icon -->
                             <span class="material-symbols-outlined text-3xl">support_agent</span>
                        </div>
                    </a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
