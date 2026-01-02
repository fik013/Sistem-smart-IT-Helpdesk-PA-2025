<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Smart IT Helpdesk - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-white min-h-screen flex flex-col">
    <!-- Header -->
    <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-border-dark px-10 py-4 bg-white dark:bg-background-dark">
        <div class="flex items-center gap-4 text-slate-900 dark:text-white">
            <div class="size-8 text-primary">
                {{-- Logo SVG --}}
                <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M39.5563 34.1455V13.8546C39.5563 15.708 36.8773 17.3437 32.7927 18.3189C30.2914 18.916 27.263 19.2655 24 19.2655C20.737 19.2655 17.7086 18.916 15.2073 18.3189C11.1227 17.3437 8.44365 15.708 8.44365 13.8546V34.1455C8.44365 35.9988 11.1227 37.6346 15.2073 38.6098C17.7086 39.2069 20.737 39.5564 24 39.5564C27.263 39.5564 30.2914 39.2069 32.7927 38.6098C36.8773 37.6346 39.5563 35.9988 39.5563 34.1455Z" fill="currentColor"></path>
                    <path clip-rule="evenodd" d="M10.4485 13.8519C10.4749 13.9271 10.6203 14.246 11.379 14.7361C12.298 15.3298 13.7492 15.9145 15.6717 16.3735C18.0007 16.9296 20.8712 17.2655 24 17.2655C27.1288 17.2655 29.9993 16.9296 32.3283 16.3735C34.2508 15.9145 35.702 15.3298 36.621 14.7361C37.3796 14.246 37.5251 13.9271 37.5515 13.8519C37.5287 13.7876 37.4333 13.5973 37.0635 13.2931C36.5266 12.8516 35.6288 12.3647 34.343 11.9175C31.79 11.0295 28.1333 10.4437 24 10.4437C19.8667 10.4437 16.2099 11.0295 13.657 11.9175C12.3712 12.3647 11.4734 12.8516 10.9365 13.2931C10.5667 13.5973 10.4713 13.7876 10.4485 13.8519ZM37.5563 18.7877C36.3176 19.3925 34.8502 19.8839 33.2571 20.2642C30.5836 20.9025 27.3973 21.2655 24 21.2655C20.6027 21.2655 17.4164 20.9025 14.7429 20.2642C13.1498 19.8839 11.6824 19.3925 10.4436 18.7877V34.1275C10.4515 34.1545 10.5427 34.4867 11.379 35.027C12.298 35.6207 13.7492 36.2054 15.6717 36.6644C18.0007 37.2205 20.8712 37.5564 24 37.5564C27.1288 37.5564 29.9993 37.2205 32.3283 36.6644C34.2508 36.2054 35.702 35.6207 36.621 35.027C37.4573 34.4867 37.5485 34.1546 37.5563 34.1275V18.7877ZM41.5563 13.8546V34.1455C41.5563 36.1078 40.158 37.5042 38.7915 38.3869C37.3498 39.3182 35.4192 40.0389 33.2571 40.5551C30.5836 41.1934 27.3973 41.5564 24 41.5564C20.6027 41.5564 17.4164 41.1934 14.7429 40.5551C12.5808 40.0389 10.6502 39.3182 9.20848 38.3869C7.84205 37.5042 6.44365 36.1078 6.44365 34.1455L6.44365 13.8546C6.44365 12.2684 7.37223 11.0454 8.39581 10.2036C9.43325 9.3505 10.8137 8.67141 12.343 8.13948C15.4203 7.06909 19.5418 6.44366 24 6.44366C28.4582 6.44366 32.5797 7.06909 35.657 8.13948C37.1863 8.67141 38.5667 9.3505 39.6042 10.2036C40.6278 11.0454 41.5563 12.2684 41.5563 13.8546Z" fill="currentColor" fill-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Smart IT Helpdesk</h2>
        </div>
        <div class="flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-6">
                <a class="text-slate-600 dark:text-text-secondary hover:text-primary text-sm font-medium leading-normal transition-colors" href="#">Support</a>
                <a class="text-slate-600 dark:text-text-secondary hover:text-primary text-sm font-medium leading-normal transition-colors" href="#">System Status</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col items-center justify-center p-4 relative overflow-hidden">
        <!-- Abstract Background Decoration -->
        <div class="absolute inset-0 z-0 pointer-events-none opacity-20 dark:opacity-40">
            <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-primary rounded-full blur-[120px] opacity-20"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-purple-500 rounded-full blur-[120px] opacity-20"></div>
        </div>

        <div class="layout-content-container flex flex-col w-full max-w-[1200px] flex-1 justify-center z-10">
            <div class="flex flex-col lg:flex-row gap-12 items-center justify-center">
                
                <!-- Left Side: Hero Text (Desktop) -->
                <div class="hidden lg:flex flex-col flex-1 max-w-[500px] gap-6">
                    <div class="flex flex-col gap-4">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 w-fit border border-primary/20">
                            <span class="size-2 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-xs font-medium text-primary uppercase tracking-wide">System Operational</span>
                        </span>
                        <h1 class="text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] text-slate-900 dark:text-white">
                            Selamat Datang
                        </h1>
                        <p class="text-slate-500 dark:text-text-secondary text-lg font-normal leading-relaxed">
                            Selesaikan permasalahan IT Anda dengan cepat dan efektif disini.
                        </p>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <div class="flex -space-x-3">
                             <!-- Using generic user avatars usually, here using placeholders or remove -->
                             <div class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark bg-gray-500"></div>
                             <div class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark bg-gray-600"></div>
                             <div class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark bg-gray-700"></div>
                             <div class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark bg-surface-dark flex items-center justify-center text-xs font-bold text-white">2k+</div>
                        </div>
                        <p class="text-sm font-medium text-slate-600 dark:text-text-secondary">Tickets resolved today</p>
                    </div>
                </div>

                <!-- Right Side: Login Card -->
                <div class="w-full max-w-[440px] flex-shrink-0">
                    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-2xl border border-gray-200 dark:border-border-dark overflow-hidden">
                        <div class="p-8 pb-0">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Log In</h2>
                                    <p class="text-sm text-slate-500 dark:text-text-secondary mt-1">Enter your credentials</p>
                                </div>
                                <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-2xl">lock_person</span>
                                </div>
                            </div>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="px-8 pb-8 pt-2 flex flex-col gap-5">
                            @csrf
                            <!-- Email/Username Field -->
                            <label class="flex flex-col gap-1.5">
                                <span class="text-sm font-semibold text-slate-700 dark:text-white">Email</span>
                                <div class="relative flex items-center">
                                    <span class="absolute left-3.5 text-slate-400 dark:text-text-secondary material-symbols-outlined text-[20px]">person</span>
                                    <input type="email" name="email" class="form-input w-full rounded-lg border-gray-300 dark:border-border-dark bg-gray-50 dark:bg-[#111822] text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary pl-10 py-3 text-sm transition-all" placeholder="user@example.com" required autofocus value="{{ old('email') }}"/>
                                </div>
                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </label>

                            <!-- Password Field -->
                            <label class="flex flex-col gap-1.5">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-semibold text-slate-700 dark:text-white">Password</span>
                                    @if (Route::has('password.request'))
                                    <a class="text-xs font-medium text-primary hover:underline" href="{{ route('password.request') }}">Forgot password?</a>
                                    @endif
                                </div>
                                <div class="relative flex items-center group">
                                    <span class="absolute left-3.5 text-slate-400 dark:text-text-secondary material-symbols-outlined text-[20px]">lock</span>
                                    <input id="password" type="password" name="password" class="form-input w-full rounded-lg border-gray-300 dark:border-border-dark bg-gray-50 dark:bg-[#111822] text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary pl-10 pr-10 py-3 text-sm transition-all" placeholder="••••••••" required autocomplete="current-password"/>
                                    <button type="button" onclick="togglePassword()" class="absolute right-3.5 text-slate-400 dark:text-text-secondary hover:text-slate-600 dark:hover:text-white focus:outline-none transition-colors">
                                        <span id="eye-icon" class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>
                                </div>
                                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </label>


                            <!-- Submit Button -->
                            <button type="submit" class="mt-2 w-full bg-primary hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg transition-all shadow-lg shadow-primary/25 active:scale-[0.98] flex items-center justify-center gap-2">
                                <span>Sign In</span>
                                <span class="material-symbols-outlined text-lg">arrow_forward</span>
                            </button>

                            <!-- Security Notice -->
                            <div class="flex items-start gap-3 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/30 mt-4">
                                <span class="material-symbols-outlined text-primary text-xl mt-0.5">verified_user</span>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                    This system is monitored. Unauthorized access attempts are logged.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
