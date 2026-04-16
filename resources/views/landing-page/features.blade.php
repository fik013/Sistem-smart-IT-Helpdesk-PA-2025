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
    <title>Sistem Smart IT Helpdesk</title>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-200 antialiased">
    <!-- Header Navigation -->
    <nav class="sticky top-0 z-50 border-b border-primary/10 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('landing-page') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                    <div class="w-8 h-8 bg-primary rounded flex items-center justify-center">
                        <span class="material-icons text-white text-sm">support_agent</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900 dark:text-white">Smart<span class="text-primary">Desk</span></span>
                </a>
                <div class="hidden md:flex gap-8 text-sm font-medium">
                    <a class="hover:text-primary transition-colors" href="#fitur">Fitur Unggulan</a>
                    <a class="hover:text-primary transition-colors" href="#saw">Sistem Prioritas (SAW)</a>
                    <a class="hover:text-primary transition-colors" href="#keunggulan">Keunggulan Lain</a>
                </div>
                <div class="flex items-center gap-4">
                    <button id="theme-toggle" type="button" class="text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full text-sm p-2 transition-colors flex items-center justify-center w-10 h-10">
                        <span id="theme-toggle-dark-icon" class="material-icons hidden">dark_mode</span>
                        <span id="theme-toggle-light-icon" class="material-icons hidden">light_mode</span>
                    </button>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-primary hover:bg-primary/90 text-white px-5 py-2 rounded-lg font-medium transition-all text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-primary hover:bg-primary/90 text-white px-5 py-2 rounded-lg font-medium transition-all text-sm">
                            Login Portal
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-16 lg:py-24">
        <!-- Section Header -->
        <div class="max-w-4xl mx-auto text-center px-4 mb-20">
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
                        Smart IT Helpdesk terintegrasi dengan chatbot berbasis AI (Gemini) tingkat lanjut untuk membantu keluhan pengguna secara real-time. Sistem kami membantu menyajikan solusi instan dari basis pengetahuan internal secara interaktif.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="material-icons text-primary text-xl">check_circle</span>
                            <span><strong>AI Chatbot (Gemini):</strong> Membantu memberikan jawaban instan mengenai pertanyaan umum tanpa harus menunggu staf IT.</span>
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
                            <span class="text-xs text-slate-400 font-mono ml-4">gemini-ai-engine --stream log</span>
                        </div>
                        <div class="p-6 font-mono text-sm space-y-3">
                            <div class="flex gap-3">
                                <span class="text-emerald-400">[USER]</span>
                                <span class="text-slate-300">Bagaimana cara mengatasi internet yang tidak tersambung?</span>
                            </div>
                            <div class="flex gap-3">
                                <span class="text-primary">[AI CHATBOT]</span>
                                <span class="text-slate-300">Menganalisa pertanyaan menggunakan model Gemini...</span>
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
        <section id="saw" class="bg-primary/5 py-24">
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
                                <div class="text-primary font-bold text-2xl mb-1">C4</div>
                                <div class="text-xs uppercase tracking-wider text-slate-500 mb-4">Jabatan Pengguna</div>
                                <div class="h-1 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                    <div class="bg-primary h-full w-[20%]"></div>
                                </div>
                            </div>
                            <div class="bg-primary p-4 rounded-xl shadow-xl flex flex-col justify-center items-center text-center">
                                <div class="text-white font-bold text-3xl mb-1">SAW</div>
                                <div class="text-xs text-white/80">Algoritma Prioritas</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="inline-flex items-center justify-center p-3 bg-primary/10 rounded-xl mb-6">
                            <span class="material-icons text-primary">balance</span>
                        </div>
                        <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Algoritma SAW: Prioritas Adil &amp; Transparan</h3>
                        <p class="text-slate-600 dark:text-slate-400 mb-8 text-lg">
                            Tidak ada lagi pilih kasih dalam penanganan tiket. Dengan metode <i>Simple Additive Weighting</i> (SAW), setiap tiket komplain diberikan skor berdasarkan kriteria objektif seperti Tingkat Urgensi, Jenis Aset, Target Tujuan, hingga Jabatan Pengguna.
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

        <!-- Final CTA Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <div class="bg-gradient-to-br from-primary to-blue-700 rounded-3xl p-12 lg:p-20 relative overflow-hidden">
                <!-- Abstract patterns -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Transformasi Layanan IT Anda?</h2>
                    <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                        Mulai tingkatkan produktivitas kerja dan kepuasan karyawan dengan transparansi dan kecerdasan dalam IT Helpdesk.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}" class="bg-white text-primary hover:bg-slate-100 px-8 py-4 rounded-xl font-bold transition-all shadow-lg inline-block">
                            Masuk Portal Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-primary/10 bg-background-light dark:bg-background-dark py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded flex items-center justify-center">
                        <span class="material-icons text-white text-sm">support_agent</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900 dark:text-white">Smart<span class="text-primary">Desk</span></span>
                </div>
                <p class="text-slate-500 text-sm">© {{ date('Y') }} Sistem Smart IT Helpdesk PA. All rights reserved.</p>
                <div class="flex gap-6 text-slate-500">
                    <a class="hover:text-primary transition-colors" href="#"><span class="material-icons text-lg">language</span></a>
                    <a class="hover:text-primary transition-colors" href="#"><span class="material-icons text-lg">terminal</span></a>
                    <a class="hover:text-primary transition-colors" href="#"><span class="material-icons text-lg">description</span></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && document.documentElement.classList.contains('dark'))) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

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
        });
    </script>
</body>
</html>
