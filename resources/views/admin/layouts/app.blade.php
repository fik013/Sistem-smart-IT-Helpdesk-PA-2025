<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Panel - Smart IT Helpdesk')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Fonts: Inter -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
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
    <!-- Page Transition Loader -->
    @if(session('login_success'))
        <div id="page-loader" class="fixed inset-0 z-[9999] bg-[#f6f7f8] dark:bg-[#101822] flex flex-col items-center justify-center transition-opacity duration-700 ease-in-out">
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
                <h1 class="text-2xl font-black tracking-tight text-[#101822] dark:text-white">Smart IT Helpdesk</h1>
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
        </div>
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
    @else
        <!-- Simple Bounce Loader for Regular Navigation -->
        <div id="page-loader" class="fixed inset-0 z-[9999] bg-[#f6f7f8] dark:bg-[#101822] flex items-center justify-center transition-opacity duration-500 ease-in-out">
            <div class="flex flex-col items-center gap-3 animate-bounce">
                <div class="size-20 bg-primary/10 rounded-full flex items-center justify-center text-primary shadow-lg shadow-primary/20 ring-4 ring-primary/5">
                    <span class="material-symbols-outlined text-5xl">support_agent</span>
                </div>
                <div class="flex flex-col items-center">
                    <h1 class="text-2xl font-black tracking-tight text-[#101822] dark:text-white">Smart IT Helpdesk</h1>
                    <p class="text-sm font-medium text-slate-500 dark:text-[#92a9c9]">Memuat...</p>
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
    <div class="flex h-screen w-full flex-col overflow-hidden">
        <!-- TopNavBar -->
        <header class="flex flex-none items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-[#233348] bg-white dark:bg-[#111822] px-10 py-3 z-20 transition-colors duration-200">
            <div class="flex items-center gap-4 text-[#101822] dark:text-white">
                <div class="size-8 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined" style="font-size: 32px;">dns</span>
                </div>
                <h2 class="text-[#101822] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Smart IT Helpdesk</h2>
                <button onclick="toggleSidebar()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-[#233348] text-slate-500 dark:text-[#92a9c9] transition-colors focus:outline-none ml-2">
                     <span id="toggle-icon" class="material-symbols-outlined">menu_open</span>
                </button>
            </div>
            <div class="flex flex-1 justify-end gap-8">
                <div class="flex gap-2 relative" x-data="{ notifOpen: false }">
                    <button @click="notifOpen = !notifOpen" class="relative flex size-10 cursor-pointer items-center justify-center rounded-lg bg-slate-100 dark:bg-[#233348] text-slate-600 dark:text-white hover:bg-slate-200 dark:hover:bg-[#324867] transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-2 right-2 flex h-2.5 w-2.5">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                            </span>
                        @endif
                    </button>
                    
                    <!-- Notification Popup -->
                    <div x-show="notifOpen" 
                         @click.away="notifOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute top-12 right-0 w-80 z-50 rounded-xl border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e] shadow-xl overflow-hidden"
                         style="display: none;">
                        
                        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-[#233348]">
                            <h3 class="font-bold text-[#101822] dark:text-white">Notifikasi</h3>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <form action="{{ route('notifications.readAll') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs text-primary hover:text-blue-600 font-bold hover:underline">Tandai dibaca</button>
                                </form>
                            @endif
                        </div>
                        
                        <div class="max-h-[400px] overflow-y-auto custom-scrollbar">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="flex flex-col gap-1 p-4 border-b border-slate-100 dark:border-[#233348] bg-blue-50/50 dark:bg-blue-900/10 hover:bg-slate-50 dark:hover:bg-[#233348]/50 transition-colors">
                                    <div class="flex justify-between items-start gap-2">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm text-primary">{{ $notification->data['icon'] ?? 'notifications' }}</span>
                                            <span class="font-bold text-[#101822] dark:text-white text-sm line-clamp-1">{{ $notification->data['message'] ?? 'Notification' }}</span>
                                        </div>
                                        <span class="text-[10px] text-slate-500 dark:text-[#92a9c9] whitespace-nowrap flex-shrink-0">{{ $notification->created_at->diffForHumans(null, true, true) }}</span>
                                    </div>
                                    <p class="text-xs text-slate-500 dark:text-[#92a9c9] pl-6 line-clamp-2">Baru saja</p>
                                </a>
                            @empty
                                @if(auth()->user()->readNotifications->isEmpty())
                                    <div class="p-8 text-center flex flex-col items-center gap-2 text-slate-400 dark:text-[#92a9c9]">
                                        <span class="material-symbols-outlined text-4xl opacity-50">notifications_off</span>
                                        <span class="text-sm">Belum ada notifikasi</span>
                                    </div>
                                @endif
                            @endforelse

                            @if(auth()->user()->readNotifications->isNotEmpty())
                                <div class="px-4 py-2 bg-slate-50 dark:bg-[#1f2937] text-xs font-bold text-slate-500 uppercase tracking-wider border-y border-slate-100 dark:border-[#233348]">
                                    Terbaca
                                </div>
                                @foreach(auth()->user()->readNotifications->take(5) as $notification)
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="flex flex-col gap-1 p-4 border-b border-slate-100 dark:border-[#233348] hover:bg-slate-50 dark:hover:bg-[#233348]/50 transition-colors opacity-75 hover:opacity-100">
                                        <div class="flex justify-between items-start gap-2">
                                            <div class="flex items-center gap-2">
                                                <span class="material-symbols-outlined text-sm text-slate-400">{{ $notification->data['icon'] ?? 'notifications' }}</span>
                                                <span class="font-medium text-slate-700 dark:text-slate-300 text-sm line-clamp-1">{{ $notification->data['message'] ?? 'Notification' }}</span>
                                            </div>
                                            <span class="text-[10px] text-slate-400 dark:text-slate-600 whitespace-nowrap flex-shrink-0">{{ $notification->created_at->diffForHumans(null, true, true) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <button id="themeToggle" class="flex size-10 cursor-pointer items-center justify-center rounded-lg bg-slate-100 dark:bg-[#233348] text-slate-600 dark:text-white hover:bg-slate-200 dark:hover:bg-[#324867] transition-colors">
                        <span class="material-symbols-outlined" id="themeIcon">light_mode</span>
                    </button>
                </div>
                <div class="relative">
                    <button onclick="document.getElementById('profile-popup').classList.toggle('hidden')" class="flex items-center gap-2 focus:outline-none transition-transform active:scale-95">
                        <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 border border-slate-200 dark:border-[#233348]" 
                             style="background-image: url('{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}');">
                        </div>
                    </button>
                    <!-- Profile Popup -->
                    <div id="profile-popup" class="hidden absolute top-12 right-0 w-56 z-50 rounded-xl border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e] shadow-xl overflow-hidden py-1">
                        <div class="px-4 py-3 border-b border-slate-200 dark:border-[#233348]">
                            <p class="text-sm font-bold text-[#101822] dark:text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 dark:text-[#92a9c9] truncate capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#233348] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">account_circle</span>
                            Kelola Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">logout</span>
                                Logout
                            </button>
                        </form>
                    </div>
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

    <!-- Global Success Modal -->
    @if(session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        
        <div @click.away="show = false" 
             x-show="show"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-90 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="bg-white dark:bg-[#1a232e] rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center border border-slate-200 dark:border-[#233348] relative overflow-hidden">
            
            <!-- Success Animation -->
            <div class="mb-6 flex justify-center">
                <div class="success-checkmark">
                    <div class="check-icon">
                        <span class="icon-line line-tip"></span>
                        <span class="icon-line line-long"></span>
                        <div class="icon-circle"></div>
                        <div class="icon-fix"></div>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-black text-[#101822] dark:text-white mb-2">Berhasil!</h3>
            <p class="text-slate-500 dark:text-[#92a9c9] mb-8 leading-relaxed">
                {{ session('success') }}
            </p>

            <button @click="show = false" 
                    class="w-full py-3 px-6 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-blue-500/20 active:scale-95">
                Selesai
            </button>
        </div>
    </div>

    <style>
        .success-checkmark {
            width: 80px;
            height: 115px;
            margin: 0 auto;
        }
        .success-checkmark .check-icon {
            width: 80px;
            height: 80px;
            position: relative;
            border-radius: 50%;
            box-sizing: content-box;
            border: 4px solid #4caf50;
        }
        .success-checkmark .check-icon::before {
            top: 3px;
            left: -2px;
            width: 30px;
            transform-origin: 100% 50%;
            border-radius: 100px 0 0 100px;
        }
        .success-checkmark .check-icon::after {
            top: 0;
            left: 30px;
            width: 60px;
            transform-origin: 0 50%;
            border-radius: 0 100px 100px 0;
            animation: rotate-circle 4.25s ease-in;
        }
        .success-checkmark .check-icon::before, .success-checkmark .check-icon::after {
            content: "";
            height: 100px;
            position: absolute;
            background: transparent;
            transform: rotate(-45deg);
        }
        .success-checkmark .check-icon .icon-line {
            height: 5px;
            background-color: #4caf50;
            display: block;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
        }
        .success-checkmark .check-icon .icon-line.line-tip {
            top: 46px;
            left: 14px;
            width: 25px;
            transform: rotate(45deg);
            animation: icon-line-tip 0.75s;
        }
        .success-checkmark .check-icon .icon-line.line-long {
            top: 38px;
            right: 8px;
            width: 47px;
            transform: rotate(-45deg);
            animation: icon-line-long 0.75s;
        }
        .success-checkmark .check-icon .icon-circle {
            top: -4px;
            left: -4px;
            z-index: 10;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 4px solid rgba(76, 175, 80, 0.2);
            box-sizing: content-box;
            position: absolute;
        }
        .success-checkmark .check-icon .icon-fix {
            top: 8px;
            width: 5px;
            left: 28px;
            z-index: 1;
            height: 85px;
            position: absolute;
            transform: rotate(-45deg);
            background-color: transparent;
        }

        @keyframes rotate-circle {
            0% { transform: rotate(-45deg); }
            5% { transform: rotate(-45deg); }
            12% { transform: rotate(-405deg); }
            100% { transform: rotate(-405deg); }
        }
        @keyframes icon-line-tip {
            0% { width: 0; left: 1px; top: 19px; }
            54% { width: 0; left: 1px; top: 19px; }
            70% { width: 50px; left: -8px; top: 37px; }
            84% { width: 17px; left: 21px; top: 48px; }
            100% { width: 25px; left: 14px; top: 46px; }
        }
        @keyframes icon-line-long {
            0% { width: 0; right: 46px; top: 54px; }
            65% { width: 0; right: 46px; top: 54px; }
            84% { width: 55px; right: 0px; top: 35px; }
            100% { width: 47px; right: 8px; top: 38px; }
        }
    </style>
    @endif

    <!-- Global Delete Confirmation Modal -->
    <div x-data="{ 
            show: false, 
            formToSubmit: null,
            message: 'Apakah Anda yakin ingin menghapus data ini?',
            init() {
                window.addEventListener('open-delete-modal', (e) => {
                    this.formToSubmit = e.detail.form;
                    this.message = e.detail.message || this.message;
                    this.show = true;
                });
            },
            submitForm() {
                if(this.formToSubmit) {
                    this.formToSubmit.submit();
                }
            }
         }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[10000] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         style="display: none;">
        
        <div @click.away="show = false"
             x-show="show"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-90 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="bg-white dark:bg-[#1a232e] rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center border border-slate-200 dark:border-[#233348] relative overflow-hidden">
            
            <!-- Warning Icon -->
            <div class="mb-6 flex justify-center text-red-600">
                <div class="h-20 w-20 bg-red-100 dark:bg-red-500/10 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-5xl">warning</span>
                </div>
            </div>

            <h3 class="text-xl font-black text-[#101822] dark:text-white mb-2">Konfirmasi Hapus</h3>
            <p class="text-slate-500 dark:text-[#92a9c9] mb-8 leading-relaxed" x-text="message"></p>

            <div class="flex gap-3">
                <button @click="show = false" 
                        class="flex-1 py-3 px-6 bg-slate-100 dark:bg-[#233348] hover:bg-slate-200 dark:hover:bg-[#324867] text-slate-700 dark:text-white font-bold rounded-xl transition-all active:scale-95">
                    Batal
                </button>
                <button @click="submitForm()" 
                        class="flex-1 py-3 px-6 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-red-600/20 active:scale-95">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    @stack('scripts')
    <script>
        // Global delete confirmation helper
        function confirmDelete(button, message) {
            const form = button.closest('form');
            window.dispatchEvent(new CustomEvent('open-delete-modal', {
                detail: { form: form, message: message }
            }));
            return false;
        }

        // Sidebar Toggle Logic
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const sidebarHeader = document.getElementById('sidebar-header');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const toggleIcon = document.getElementById('toggle-icon');
            
            // Toggle Width
            if (sidebar.classList.contains('w-64')) {
                // Collapse
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                
                // Hide Header
                sidebarHeader.classList.add('hidden');
                
                // Hide Text
                sidebarTexts.forEach(text => text.classList.add('hidden'));
                
                // Center Icons
                sidebarLinks.forEach(link => {
                     link.classList.remove('justify-start');
                     link.classList.add('justify-center');
                });

                // Change Icon
                toggleIcon.textContent = 'menu';
            } else {
                // Expand
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                
                 // Show Header
                sidebarHeader.classList.remove('hidden');
                
                // Show Text
                sidebarTexts.forEach(text => text.classList.remove('hidden'));
                
                 // Reset Alignment
                sidebarLinks.forEach(link => {
                     link.classList.remove('justify-center');
                     link.classList.add('justify-start');
                });

                // Change Icon
                toggleIcon.textContent = 'menu_open';
            }
        }

        const themeToggleBtn = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const htmlElement = document.documentElement;

        // Check local storage or system preference
        if (localStorage.theme === 'dark') {
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
