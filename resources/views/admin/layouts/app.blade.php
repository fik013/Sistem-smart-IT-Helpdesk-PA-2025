<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Panel - Smart IT Helpdesk')</title>
    <!-- Fonts: Inter -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
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
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    @stack('styles')
</head>
<body class="bg-[#f6f7f8] dark:bg-[#101822] font-display text-[#101822] dark:text-white overflow-hidden transition-colors duration-200">
    <div class="flex h-screen w-full flex-col overflow-hidden">
        <!-- TopNavBar -->
        <header class="flex flex-none items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-[#233348] bg-white dark:bg-[#111822] px-10 py-3 z-20 transition-colors duration-200">
            <div class="flex items-center gap-4 text-[#101822] dark:text-white">
                <div class="size-8 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined" style="font-size: 32px;">dns</span>
                </div>
                <h2 class="text-[#101822] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Smart IT Helpdesk</h2>
            </div>
            <div class="flex flex-1 justify-end gap-8">
                <div class="flex gap-2 relative">
                    <button onclick="document.getElementById('notification-popup').classList.toggle('hidden')" class="relative flex size-10 cursor-pointer items-center justify-center rounded-lg bg-slate-100 dark:bg-[#233348] text-slate-600 dark:text-white hover:bg-slate-200 dark:hover:bg-[#324867] transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                        @php
                            $pendingCount = \App\Models\Ticket::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="absolute top-2 right-2 flex h-2.5 w-2.5">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                            </span>
                        @endif
                    </button>
                    <!-- Notification Popup -->
                    <div id="notification-popup" class="hidden absolute top-12 right-0 w-80 z-50 rounded-xl border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e] shadow-xl overflow-hidden">
                        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-[#233348]">
                            <h3 class="font-bold text-[#101822] dark:text-white">Notifications</h3>
                            @if($pendingCount > 0)
                                <span class="bg-primary/20 text-primary text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }} New</span>
                            @endif
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            @if($pendingCount > 0)
                                @foreach(\App\Models\Ticket::where('status', 'pending')->latest()->take(5)->get() as $ticket)
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="flex flex-col gap-1 p-4 border-b border-slate-200 dark:border-[#233348] hover:bg-slate-50 dark:hover:bg-[#233348]/50 transition-colors">
                                        <div class="flex justify-between items-start">
                                            <span class="font-medium text-[#101822] dark:text-white text-sm line-clamp-1">{{ $ticket->subject }}</span>
                                            <span class="text-[10px] text-slate-500 dark:text-[#92a9c9] whitespace-nowrap">{{ $ticket->created_at->diffForHumans(null, true, true) }}</span>
                                        </div>
                                        <p class="text-xs text-slate-500 dark:text-[#92a9c9]">New ticket from {{ $ticket->user->name }}</p>
                                    </a>
                                @endforeach
                                <div class="p-2 text-center">
                                    <a href="{{ route('admin.tickets.index') }}" class="text-xs text-primary hover:text-blue-400 font-medium">View all pending tickets</a>
                                </div>
                            @else
                                <div class="p-8 text-center text-slate-500 dark:text-[#92a9c9] text-sm">
                                    No new notifications
                                </div>
                            @endif
                        </div>
                    </div>

                    <button id="themeToggle" class="flex size-10 cursor-pointer items-center justify-center rounded-lg bg-slate-100 dark:bg-[#233348] text-slate-600 dark:text-white hover:bg-slate-200 dark:hover:bg-[#324867] transition-colors">
                        <span class="material-symbols-outlined" id="themeIcon">light_mode</span>
                    </button>
                    <!-- Settings Button (Optional, keeping it for now if needed, or remove if redundant) -->
                    <!-- <button class="flex size-10 cursor-pointer items-center justify-center rounded-lg bg-slate-100 dark:bg-[#233348] text-slate-600 dark:text-white hover:bg-slate-200 dark:hover:bg-[#324867] transition-colors">
                        <span class="material-symbols-outlined">settings</span>
                    </button> -->
                </div>
                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 border border-slate-200 dark:border-[#233348]" 
                     style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}");'>
                </div>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">
            <!-- Reuse Sidebar -->
            @include('admin.layouts.sidebar')

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-[#f6f7f8] dark:bg-[#111822] transition-colors duration-200">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
    <script>
        const themeToggleBtn = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const htmlElement = document.documentElement;

        // Check local storage or system preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
            themeIcon.textContent = 'light_mode'; // Icon to switch to light
        } else {
            htmlElement.classList.remove('dark');
            themeIcon.textContent = 'dark_mode'; // Icon to switch to dark
        }

        themeToggleBtn.addEventListener('click', function() {
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.theme = 'light';
                themeIcon.textContent = 'dark_mode';
            } else {
                htmlElement.classList.add('dark');
                localStorage.theme = 'dark';
                themeIcon.textContent = 'light_mode';
            }
        });
    </script>
</body>
</html>
