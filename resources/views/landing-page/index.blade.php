<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>SmartDesk - Solusi IT Helpdesk Cerdas</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#136dec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101822",
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
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased transition-colors duration-300">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-primary p-1.5 rounded-lg">
                        <span class="material-icons text-white">bolt</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">SmartDesk</span>
                </div>
                <div class="hidden md:flex space-x-6 lg:space-x-8 items-center">
                    <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('landing-page.features') }}">Fitur Unggulan</a>
                    <a class="text-sm font-medium hover:text-primary transition-colors" href="#solution">Solusi</a>
                    <!-- <a class="text-sm font-medium hover:text-primary transition-colors" href="#pricing">Harga</a> -->
                    
                    <div class="flex items-center gap-4 ml-4">
                        <button id="theme-toggle" type="button" class="text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full text-sm p-2 transition-colors flex items-center justify-center w-10 h-10">
                            <span id="theme-toggle-dark-icon" class="material-icons hidden">dark_mode</span>
                            <span id="theme-toggle-light-icon" class="material-icons hidden">light_mode</span>
                        </button>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-medium bg-primary text-white px-5 py-2.5 rounded-lg shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                                Dashboard
                            </a>
                        @else
                            <a class="text-sm font-medium px-4 py-2 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-all" href="{{ route('login') }}">Login</a>
                            <a class="text-sm font-medium bg-primary text-white px-5 py-2 rounded-lg shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all" href="{{ route('login') }}">Coba Gratis</a>
                        @endauth
                    </div>
                </div>
                <div class="md:hidden flex items-center gap-2">
                    <button id="theme-toggle-mobile" type="button" class="text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full text-sm p-2 transition-colors flex items-center justify-center w-10 h-10">
                        <span id="theme-toggle-dark-icon-mobile" class="material-icons hidden">dark_mode</span>
                        <span id="theme-toggle-light-icon-mobile" class="material-icons hidden">light_mode</span>
                    </button>
                    <span class="material-icons">menu</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-20 pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary text-xs font-semibold tracking-wide uppercase">
                        Terintegrasi AI Generation
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                        Revolusi <span class="text-primary">Support IT</span> dengan Kecerdasan Buatan.
                    </h1>
                    <p class="text-lg text-slate-500 dark:text-slate-400 max-w-xl leading-relaxed">
                        Optimalkan workflow helpdesk Anda dengan sistem penentuan prioritas otomatis menggunakan algoritma SAW dan manajemen inventaris terintegrasi dalam satu platform modern.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-primary text-center text-white font-bold rounded-xl shadow-xl shadow-primary/30 hover:scale-105 transition-transform">
                            Coba Gratis Sekarang
                        </a>
                        <button class="px-8 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 font-bold rounded-xl flex items-center justify-center gap-2 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                            <span class="material-icons">play_circle_outline</span> Lihat Demo
                        </button>
                    </div>
                    <!-- <div class="flex items-center gap-4 text-sm text-slate-400">
                        <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-background-dark" alt="Avatar user testimonial 1" src="https://lh3.googleusercontent.com/aida-public/AB6AXuChxZuWBkU4WKGAkPHAloXXbmCClr_XI_K-PL85J7rEKouMY_WZYlYM27Np6O7kMcBawh_5GtjrEsd4xFihjr0wyXLNHMcQGEBoUz_thSIRHtCa_t7upn6ok-YuAUGe5PcmWM_jjmyOG86bO03XSB836Hx4xlFkaKKg_D40B9x45QL0EYb8NgbJ65tS_o7qKLhmXAHBNV4Vq5bDGFkRAzedA8NYO_u0ppKUy2mQZXZ6AuWzgl7KIKuM9FH0o_VkpcOcwkQ2aabYr6w"/>
                            <img class="w-8 h-8 rounded-full border-2 border-background-dark" alt="Avatar user testimonial 2" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD03GI_2x9HboLr3J42HOwZo6GyEaYJwbiQF4kR9_13nmvwZfkGXMEcWojzmBvdJyu6CNFEyU76uBYC_Gcj5e5OAmZiL1IvEl1__ICEE82nlowQo0OAybOxEQhnZ4qdCukCWqNAJ7rRB6B0bR9pCd3WGnVPvcp8wdQOWDwjrwvd74ss-6Cqxlo8NvhhNzqrk3rFbXUlcFUhf6Js-w-m1dLj449uotR7S25OAxLqbilyt3Tz-TKusQ6Beqx4IcfagJNn-MZL60sn4Es"/>
                            <img class="w-8 h-8 rounded-full border-2 border-background-dark" alt="Avatar user testimonial 3" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPSvW2sNPbxErb30uo7e6biTOe_XpFMD-FF_JGoKWIGcUr4EoUoq2fYmTxab2MeIr0SkFjX2dKC5eugeqFRAvTmiiMZoM4KjpQFv-MEOmxLPYgyCT9swNMj2XO0MKJmp-YvvnxxRl3B-noSUCPsPiNpPPqIN6EcZvjUltL6ZPT8k8AGnHxpvo7dUGQi7oHiscaza-fsHeMauUFyDIP_3blXj5Si6jVPIMDTpLyns4trdsJvdV2PbrOg3Wx230AKFiDaAnr_fF_o38"/>
                        </div>
                        <span>Dipercaya oleh 500+ Perusahaan IT Indonesia</span>
                    </div> -->
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-primary/20 rounded-full blur-3xl opacity-30 animate-pulse"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800">
                        <img class="w-full" alt="Modern helpdesk dashboard user interface display" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVsLBn246mmCryiUfXP2mzTwWo_AkGFuAs9dPqShZFl-HqOSe9N4igIrpqs3UJKrcPQ9_AZwjY5lDFLGlCgNUlk8FNAR30fpnVQ1IDF2mcLsLKJD-rwemKZwHbVK3bqsk4m8I7mZ25zY490XzENRaIQp89URg2miFOAQCxCNZwUVMxb5W10fwapQcoiATN0iSLu_OD_8j_pKVdWRg3CT04NTQcOFf278tV5LuGw-mz4f00yKXcf2WA285zoMq8e5snDsaWdu763aY"/>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="solution" class="py-12 border-y border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-3xl font-bold text-primary">99.9%</div>
                <div class="text-sm text-slate-500">Uptime SLA</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-primary">40%</div>
                <div class="text-sm text-slate-500">Efisiensi Response</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-primary">24/7</div>
                <div class="text-sm text-slate-500">AI Assistance</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-primary">10k+</div>
                <div class="text-sm text-slate-500">Tiket Terproses</div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-slate-50/50 dark:bg-slate-900/50" id="features">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base font-bold text-primary tracking-widest uppercase mb-4">Fitur Tersembunyi</h2>
                <p class="text-3xl md:text-4xl font-bold tracking-tight">Semua yang Anda Butuhkan dalam Satu Platform</p>
                <div class="mt-8">
                    <a href="{{ route('landing-page.features') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 border border-primary text-primary hover:bg-primary hover:text-white font-bold rounded-lg transition-colors">
                        Lihat Selengkapnya Mengenai Fitur Unggulan
                        <span class="material-icons text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="p-8 bg-white dark:bg-background-dark border border-slate-200 dark:border-slate-800 rounded-2xl hover:border-primary/50 transition-all group">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-6 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <span class="material-icons">psychology</span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">AI Chatbot 24/7</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                        Bot cerdas yang mampu menangani kendala teknis dasar secara instan, mengurangi beban agen helpdesk hingga 60%.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="p-8 bg-white dark:bg-background-dark border border-slate-200 dark:border-slate-800 rounded-2xl hover:border-primary/50 transition-all group">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-6 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <span class="material-icons">priority_high</span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">SAW Priority Ranking</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                        Algoritma Simple Additive Weighting secara otomatis mengurutkan tiket berdasarkan urgensi dan dampak bisnis secara objektif.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="p-8 bg-white dark:bg-background-dark border border-slate-200 dark:border-slate-800 rounded-2xl hover:border-primary/50 transition-all group">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-6 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        <span class="material-icons">inventory_2</span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Inventory Management</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                        Manajemen aset IT yang terintegrasi langsung dengan tiket. Pantau kesehatan hardware dan lisensi software dalam satu tampilan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-primary rounded-3xl p-8 md:p-16 flex flex-col md:flex-row gap-12 items-center">
                <div class="flex-1 text-white">
                    <span class="material-icons text-5xl opacity-50 mb-6">format_quote</span>
                    <p class="text-2xl md:text-3xl font-medium leading-relaxed italic mb-8">
                        "Implementasi SmartDesk di perusahaan kami mengubah cara kami menangani insiden IT. Algoritma prioritasnya sangat akurat, membantu tim kami fokus pada hal yang benar-benar penting."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full overflow-hidden border-2 border-white/30">
                            <img class="w-full h-full object-cover" alt="Portrait of a CTO from a tech company" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDTHp0nurewK87Wby0hdn2pPBfT5WR3eaJj0WFOlO5UdTabOgF0wXXQzijfS50o6UBgKt8pvW10lnQqdSZ5gl9TsfTvIad4_Xb5wjOTjpps5gDO-iWIwlDSlUlvOPNONws6flKl9Ll6oyaYbgEPvYAy5qBp8aBtIR1X1fAzU6icZcuboyhs6enJcSfK5fTK4Eth-Ao8jw0YojMWfckpfhJSyMZZmh45WC7jYajnlsUdwIrfIohlO1oEI4WQwRrjL4ppxOcvZlDo23o"/>
                        </div>
                        <div>
                            <div class="font-bold">Andi Pratama</div>
                            <div class="text-white/70 text-sm">CTO, TechVision Indonesia</div>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 w-full md:w-1/3">
                    <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-6 rounded-2xl">
                        <h4 class="text-white font-bold mb-4">Hasil Nyata</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 text-white/90">
                                <span class="material-icons text-sm">check_circle</span>
                                <span>Tiket terselesaikan +35%</span>
                            </li>
                            <li class="flex items-center gap-3 text-white/90">
                                <span class="material-icons text-sm">check_circle</span>
                                <span>Waktu respon -50%</span>
                            </li>
                            <li class="flex items-center gap-3 text-white/90">
                                <span class="material-icons text-sm">check_circle</span>
                                <span>CSAT Score 4.9/5.0</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <!-- <section class="py-24" id="pricing">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Pilih Paket Sesuai Kebutuhan</h2>
                <p class="text-slate-500">Mulai gratis dan upgrade seiring pertumbuhan tim Anda.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                
                <div class="p-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl flex flex-col">
                    <h3 class="text-xl font-bold mb-2">Basic</h3>
                    <div class="text-4xl font-extrabold mb-6">Gratis</div>
                    <p class="text-sm text-slate-500 mb-8">Untuk tim IT kecil &amp; startup tahap awal.</p>
                    <ul class="space-y-4 mb-10 flex-grow">
                        <li class="flex items-center gap-2 text-sm"><span class="material-icons text-green-500 text-sm">check</span> 3 Agen IT</li>
                        <li class="flex items-center gap-2 text-sm"><span class="material-icons text-green-500 text-sm">check</span> 500 Tiket / bulan</li>
                        <li class="flex items-center gap-2 text-sm text-slate-400"><span class="material-icons text-sm">close</span> AI Chatbot</li>
                        <li class="flex items-center gap-2 text-sm text-slate-400"><span class="material-icons text-sm">close</span> SAW Prioritizing</li>
                    </ul>
                    <a href="{{ route('login') }}" class="block text-center w-full py-3 border border-primary text-primary font-bold rounded-lg hover:bg-primary/5 transition-colors">Daftar Sekarang</a>
                </div>
             
                <div class="p-8 bg-white dark:bg-slate-900 border-2 border-primary rounded-2xl flex flex-col relative scale-105 shadow-2xl z-10">
                    <div class="absolute top-0 right-8 -translate-y-1/2 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">POPULER</div>
                    <h3 class="text-xl font-bold mb-2">Pro</h3>
                    <div class="text-4xl font-extrabold mb-2">Rp 499k<span class="text-sm font-medium text-slate-500">/bln</span></div>
                    <p class="text-sm text-slate-500 mb-8">Solusi lengkap untuk operasional IT menengah.</p>
                    <ul class="space-y-4 mb-10 flex-grow">
                        <li class="flex items-center gap-2 text-sm font-medium"><span class="material-icons text-green-500 text-sm">check</span> Agen Tanpa Batas</li>
                        <li class="flex items-center gap-2 text-sm font-medium"><span class="material-icons text-green-500 text-sm">check</span> AI Chatbot Generator</li>
                        <li class="flex items-center gap-2 text-sm font-medium"><span class="material-icons text-green-500 text-sm">check</span> SAW Priority Ranking</li>
                        <li class="flex items-center gap-2 text-sm font-medium"><span class="material-icons text-green-500 text-sm">check</span> Inventory Basic</li>
                    </ul>
                    <a href="{{ route('login') }}" class="block text-center w-full py-3 bg-primary text-white font-bold rounded-lg shadow-lg shadow-primary/30 hover:bg-primary/90 transition-all">Pilih Paket Pro</a>
                </div>

                <div class="p-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl flex flex-col">
                    <h3 class="text-xl font-bold mb-2">Enterprise</h3>
                    <div class="text-4xl font-extrabold mb-6">Custom</div>
                    <p class="text-sm text-slate-500 mb-8">Kustomisasi penuh untuk skala enterprise.</p>
                    <ul class="space-y-4 mb-10 flex-grow">
                        <li class="flex items-center gap-2 text-sm"><span class="material-icons text-green-500 text-sm">check</span> Dedicated Support</li>
                        <li class="flex items-center gap-2 text-sm"><span class="material-icons text-green-500 text-sm">check</span> On-Premise Option</li>
                        <li class="flex items-center gap-2 text-sm"><span class="material-icons text-green-500 text-sm">check</span> Inventory Advanced</li>
                        <li class="flex items-center gap-2 text-sm"><span class="material-icons text-green-500 text-sm">check</span> API &amp; Webhook Integration</li>
                    </ul>
                    <a href="#" class="block text-center w-full py-3 border border-slate-300 dark:border-slate-700 font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Hubungi Sales</a>
                </div>
            </div>
        </div>
    </section> -->

    <!-- CTA Section -->
    <section class="py-24">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Siap Mengoptimalkan Support IT Anda?</h2>
            <p class="text-slate-500 mb-10 text-lg">Bergabunglah dengan ratusan perusahaan yang sudah bertransformasi digital bersama SmartDesk.</p>
            <div class="bg-primary/5 p-8 rounded-3xl border border-primary/20 flex flex-col md:flex-row items-center gap-6 justify-between">
                <div class="text-left">
                    <div class="text-xl font-bold">Mulai 14 Hari Trial</div>
                    <div class="text-sm text-slate-500">Tidak butuh kartu kredit. Setup 5 menit.</div>
                </div>
                <a href="{{ route('login') }}" class="whitespace-nowrap px-10 py-4 bg-primary text-white font-bold rounded-xl shadow-xl shadow-primary/30 hover:scale-105 transition-transform">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="bg-primary p-1 rounded-lg">
                            <span class="material-icons text-white text-sm">bolt</span>
                        </div>
                        <span class="text-lg font-bold tracking-tight">SmartDesk</span>
                    </div>
                    <p class="text-sm text-slate-500 leading-relaxed mb-6">
                        Platform IT Helpdesk masa depan dengan integrasi AI dan algoritma pengambilan keputusan cerdas.
                    </p>
                    <div class="flex gap-4">
                        <a class="text-slate-400 hover:text-primary" href="#"><span class="material-icons">facebook</span></a>
                        <a class="text-slate-400 hover:text-primary" href="#"><span class="material-icons">camera_alt</span></a>
                        <a class="text-slate-400 hover:text-primary" href="#"><span class="material-icons">language</span></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Produk</h4>
                    <ul class="space-y-4 text-sm text-slate-500">
                        <li><a class="hover:text-primary" href="#">Fitur Utama</a></li>
                        <li><a class="hover:text-primary" href="#">Integrasi AI</a></li>
                        <li><a class="hover:text-primary" href="#">SAW Algorithm</a></li>
                        <li><a class="hover:text-primary" href="#">Security</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Perusahaan</h4>
                    <ul class="space-y-4 text-sm text-slate-500">
                        <li><a class="hover:text-primary" href="#">Tentang Kami</a></li>
                        <li><a class="hover:text-primary" href="#">Karir</a></li>
                        <li><a class="hover:text-primary" href="#">Blog</a></li>
                        <li><a class="hover:text-primary" href="#">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Dukungan</h4>
                    <ul class="space-y-4 text-sm text-slate-500">
                        <li><a class="hover:text-primary" href="#">Pusat Bantuan</a></li>
                        <li><a class="hover:text-primary" href="#">Dokumentasi API</a></li>
                        <li><a class="hover:text-primary" href="#">Status Server</a></li>
                        <li><a class="hover:text-primary" href="#">Ketentuan Layanan</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-slate-500">© 2024 SmartDesk Inc. Seluruh hak cipta dilindungi.</p>
                <div class="flex gap-6 text-xs text-slate-500">
                    <a class="hover:text-primary" href="#">Privacy Policy</a>
                    <a class="hover:text-primary" href="#">Cookie Settings</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        var themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
        var themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && document.documentElement.classList.contains('dark'))) {
            themeToggleLightIcon.classList.remove('hidden');
            if(themeToggleLightIconMobile) themeToggleLightIconMobile.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
            if(themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.remove('hidden');
        }

        function toggleTheme() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            if(themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.toggle('hidden');
            if(themeToggleLightIconMobile) themeToggleLightIconMobile.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        }

        var themeToggleBtn = document.getElementById('theme-toggle');
        var themeToggleBtnMobile = document.getElementById('theme-toggle-mobile');

        if(themeToggleBtn) themeToggleBtn.addEventListener('click', toggleTheme);
        if(themeToggleBtnMobile) themeToggleBtnMobile.addEventListener('click', toggleTheme);
    </script>
</body>
</html>
