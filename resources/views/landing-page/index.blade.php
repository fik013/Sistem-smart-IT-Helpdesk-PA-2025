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
    <title>Smart IT Helpdesk - Solusi IT Helpdesk Cerdas</title>
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
                    
                    <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">Smart IT Helpdesk</span>
                </div>
                <div class="hidden md:flex space-x-6 lg:space-x-8 items-center">
                    <a class="text-sm font-medium hover:text-primary transition-colors" href="#fitur">Fitur Unggulan</a>
                    <a class="text-sm font-medium hover:text-primary transition-colors" href="#saw">Sistem Prioritas (SAW)</a>
                    <a class="text-sm font-medium hover:text-primary transition-colors" href="#keunggulan">Keunggulan</a>
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
                        <img class="w-full object-cover" alt="Sistem Smart IT Helpdesk Dashboard" src="{{ asset('images/dashboard-preview.png') }}"/>
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

    <!-- Section Header -->
    <div class="max-w-4xl mx-auto text-center px-4 mb-20 mt-24">
        <h2 class="text-primary font-semibold tracking-wide uppercase text-sm mb-3">Kecerdasan Di Balik Layanan</h2>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6 leading-tight">
            Optimalkan Efisiensi IT Dengan Teknologi Mutakhir
        </h1>
        <p class="text-lg text-slate-600 dark:text-slate-400">
            Kami menggabungkan kecerdasan buatan dan algoritma pengambilan keputusan (SAW) untuk memastikan setiap masalah IT terselesaikan dengan tepat, efisien, dan adil.
        </p>
    </div>

    <!-- AI Integration Detail -->
    <section id="fitur" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1">
                <div class="inline-flex items-center justify-center p-3 bg-primary/10 rounded-xl mb-6">
                    <span class="material-icons text-primary">auto_awesome</span>
                </div>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Penyelesaian Pintar Berbasis AI</h3>
                <p class="text-slate-600 dark:text-slate-400 mb-8 text-lg">
                    Smart IT Helpdesk terintegrasi dengan chatbot berbasis AI (Grok) tingkat lanjut untuk membantu keluhan pengguna secara real-time. Sistem kami membantu menyajikan solusi instan dari basis pengetahuan internal secara interaktif.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">check_circle</span>
                        <span><strong>AI Chatbot (Grok):</strong> Membantu memberikan jawaban instan mengenai pertanyaan umum tanpa harus menunggu staf IT.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">check_circle</span>
                        <span><strong>Efisiensi Solusi IT:</strong> Mengurangi beban staf dengan menangani FAQ (Frequently Asked Questions) lebih awal menggunakan kecerdasan buatan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-icons text-primary text-xl">check_circle</span>
                        <span><strong>Ketersediaan 24/7:</strong> Melayani bantuan dan panduan teknis bahkan sebelum tiket komplain dibuat.</span>
                    </li>
                </ul>
            </div>

            <div class="order-1 lg:order-2 relative">
                <div class="absolute inset-0 bg-primary/20 blur-[100px] rounded-full"></div>
                <div class="relative bg-slate-900 rounded-xl border border-white/10 shadow-2xl overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-3 bg-slate-800 border-b border-white/10">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <span class="text-xs text-slate-400 font-mono ml-4">Grok-ai-engine --stream log</span>
                    </div>
                    <div class="p-6 font-mono text-sm space-y-3">
                        <div class="flex gap-3">
                            <span class="text-emerald-400">[USER]</span>
                            <span class="text-slate-300">Bagaimana cara mengatasi internet yang tidak tersambung?</span>
                        </div>
                        <div class="flex gap-3">
                            <span class="text-primary">[AI CHATBOT]</span>
                            <span class="text-slate-300">Menganalisa pertanyaan menggunakan model Grok...</span>
                        </div>
                        <div class="flex gap-3">
                            <span class="text-primary">[AI CHATBOT]</span>
                            <span class="text-slate-300">Mengambil data dari FAQ basis pengetahuan perusahaan.</span>
                        </div>
                        <div class="flex gap-3">
                            <span class="text-amber-400">[ACTION]</span>
                            <span class="text-slate-300">Memberikan panduan troubleshooting langkah demi langkah secara real-time.</span>
                        </div>
                        <div class="flex gap-3 border-t border-white/10 pt-3 mt-4">
                            <span class="text-emerald-400">[RESULT]</span>
                            <span class="text-white">Status: Pertanyaan terjawab dalam 2 detik.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SAW Algorithm Detail -->
    <section id="saw" class="bg-primary/5 py-24 border-y border-primary/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-background-light dark:bg-background-dark p-4 rounded-xl border border-primary/20 shadow-lg translate-y-8">
                            <div class="text-primary font-bold text-2xl mb-1">C1</div>
                            <div class="text-xs uppercase tracking-wider text-slate-500 mb-4">Tingkat Urgensi</div>
                            <div class="h-1 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="bg-primary h-full w-[40%]"></div>
                            </div>
                        </div>
                        <div class="bg-background-light dark:bg-background-dark p-4 rounded-xl border border-primary/20 shadow-lg">
                            <div class="text-primary font-bold text-2xl mb-1">C2</div>
                            <div class="text-xs uppercase tracking-wider text-slate-500 mb-4">Jenis Aset</div>
                            <div class="h-1 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="bg-primary h-full w-[30%]"></div>
                            </div>
                        </div>
                        <div class="bg-background-light dark:bg-background-dark p-4 rounded-xl border border-primary/20 shadow-lg translate-y-8">
                            <div class="text-primary font-bold text-2xl mb-1">C3</div>
                            <div class="text-xs uppercase tracking-wider text-slate-500 mb-4">Dampak Kerusakan</div>
                            <div class="h-1 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="bg-primary h-full w-[20%]"></div>
                            </div>
                        </div>
                        <div class="bg-background-light dark:bg-background-dark p-4 rounded-xl border border-primary/20 shadow-lg">
                            <div class="text-primary font-bold text-2xl mb-1">C4</div>
                            <div class="text-xs uppercase tracking-wider text-slate-500 mb-4">Jabatan Pengguna</div>
                            <div class="h-1 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="bg-primary h-full w-[10%]"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="inline-flex items-center justify-center p-3 bg-primary/10 rounded-xl mb-6">
                        <span class="material-icons text-primary">balance</span>
                    </div>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Algoritma SAW: Prioritas Adil &amp; Transparan</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-8 text-lg">
                        Tidak ada lagi pilih kasih dalam penanganan tiket. Dengan metode <i>Simple Additive Weighting</i> (SAW), setiap tiket komplain diberikan skor berdasarkan kriteria objektif seperti Tingkat Urgensi, Jenis Aset, Dampak Kerusakan, hingga Jabatan Pengguna.
                    </p>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center font-bold text-primary">1</div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white mb-1">Manajemen Kriteria Terpadu</h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Admin memiliki fleksibilitas dalam mengatur bobot kriteria pendukung, seperti aset dan departemen perusahaan.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center font-bold text-primary">2</div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white mb-1">Normalisasi &amp; Skor Otomatis</h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Setiap pembuatan tiket secara otomatis akan menormalisasi preferensi dan menghitung peringkat untuk mengetahui seberapa kritis tiket tersebut.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center font-bold text-primary">3</div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white mb-1">Alokasi Tim Teknisi Optimal</h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Teknisi dapat menyelesaikan tiket sesuai prioritas, menghindari mismanajemen penanganan keluhan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bento Grid: Additional Benefits -->
    <section id="keunggulan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center mb-16">
            <h3 class="text-3xl font-bold text-slate-900 dark:text-white">Keunggulan Lain Dari Sistem Kami</h3>
        </div>
        <div class="grid md:grid-cols-3 gap-6">

            <!-- Bento Item 1 -->
            <div class="md:col-span-2 bg-background-light dark:bg-slate-900/50 p-8 rounded-xl border border-primary/10 flex flex-col justify-between group">
                <div>
                    <span class="material-icons text-primary mb-4 text-3xl">people_alt</span>
                    <h4 class="text-xl font-bold mb-3">Manajemen Akun &amp; Aset</h4>
                    <p class="text-slate-600 dark:text-slate-400">Kemudahan bagi Admin mengelola pengguna tiket karyawan sekaligus mendistribusikan inventaris kantor untuk tiap departemen dan individu secara aman.</p>
                </div>
                <div class="mt-8 flex gap-4 overflow-hidden">
                    <div class="h-24 flex-1 bg-primary/5 rounded border border-primary/10 p-2">
                        <div class="w-full h-full bg-gradient-to-t from-primary/40 to-transparent rounded-sm origin-bottom transform scale-y-75"></div>
                    </div>
                    <div class="h-24 flex-1 bg-primary/5 rounded border border-primary/10 p-2">
                        <div class="w-full h-full bg-gradient-to-t from-primary/40 to-transparent rounded-sm origin-bottom transform scale-y-50"></div>
                    </div>
                    <div class="h-24 flex-1 bg-primary/5 rounded border border-primary/10 p-2">
                        <div class="w-full h-full bg-gradient-to-t from-primary/60 to-transparent rounded-sm origin-bottom transform scale-y-90"></div>
                    </div>
                </div>
            </div>

            <!-- Bento Item 2 -->
            <div class="bg-primary p-8 rounded-xl flex flex-col justify-between text-white">
                <span class="material-icons mb-4 text-3xl">notifications_active</span>
                <div>
                    <h4 class="text-xl font-bold mb-3">Sistem Notifikasi Real-time</h4>
                    <p class="text-white/80">Pengguna mendapatkan notifikasi terkini tentang status tiket keluhannya yang dikirim secara interaktif langsung ke dashboard mereka.</p>
                </div>
                <div class="mt-6">
                    <span class="text-xs font-bold px-3 py-1 bg-white/20 rounded-full">FAST RESPONSE</span>
                </div>
            </div>

            <!-- Bento Item 3 -->
            <div class="bg-background-light dark:bg-slate-900/50 p-8 rounded-xl border border-primary/10 group">
                <span class="material-icons text-primary mb-4 text-3xl">report</span>
                <h4 class="text-xl font-bold mb-3">Laporan &amp; Analitik IT</h4>
                <p class="text-slate-600 dark:text-slate-400">Menyediakan rekapitulasi data tiket per periode untuk evaluasi dan peningkatan kualitas layanan instansi secara keseluruhan.</p>
            </div>

            <!-- Bento Item 4 -->
            <div class="md:col-span-2 bg-background-light dark:bg-slate-900/50 p-8 rounded-xl border border-primary/10 flex flex-col md:flex-row gap-8 items-center">
                <div class="flex-1">
                    <span class="material-icons text-primary mb-4 text-3xl">devices_other</span>
                    <h4 class="text-xl font-bold mb-3">Tampilan Responsif Multi Platform</h4>
                    <p class="text-slate-600 dark:text-slate-400">Akses modul helpdesk mulai dari dashboard karyawan, modul chatbot, hingga pelaporan tiket IT melalui desktop, tablet, maupun smartphone dengan pengalaman lancar.</p>
                </div>
                <div class="w-full md:w-1/2 flex justify-center">
                    <div class="relative w-48 h-32 bg-slate-800 rounded-lg border-4 border-slate-700 shadow-xl overflow-hidden">
                        <div class="w-full h-2 bg-slate-700 mb-2"></div>
                        <div class="p-2 space-y-1">
                            <div class="w-3/4 h-1 bg-slate-600"></div>
                            <div class="w-1/2 h-1 bg-slate-600"></div>
                        </div>
                        <div class="absolute -right-4 top-4 w-12 h-20 bg-slate-800 border-2 border-slate-700 rounded-md shadow-lg"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Quote Section -->
    <section class="py-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-primary rounded-3xl p-10 md:p-16 text-center relative overflow-hidden">
                <!-- Abstract Background Elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col items-center">
                    <span class="material-icons text-5xl md:text-6xl text-white/40 mb-6">format_quote</span>
                    <p class="text-2xl md:text-4xl font-medium leading-relaxed italic text-white mb-6">
                        "Pelayanan IT yang unggul bukan sekadar tentang memperbaiki kerusakan, tetapi tentang menjaga agar setiap orang di perusahaan tetap terhubung, produktif, dan fokus pada tujuan utama mereka."
                    </p>
                    <div class="w-16 h-1 bg-white/30 rounded-full mb-6"></div>
                    <p class="text-white/80 font-medium tracking-wide uppercase text-sm">
                        Smart IT Helpdesk Philosophy
                    </p>
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
            <p class="text-slate-500 mb-10 text-lg">Bergabunglah dengan ratusan perusahaan yang sudah bertransformasi digital bersama Smart IT Helpdesk.</p>
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
                        <span class="text-lg font-bold tracking-tight">Smart IT HelpDesk</span>
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
               
            </div>
            <div class="pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-slate-500">© 2024 Smart IT Helpdesk Inc. Seluruh hak cipta dilindungi.</p>
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
