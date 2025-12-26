@extends('admin.layouts.app')

@section('title', 'Laporan Tiket - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm print:hidden">
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <span class="text-white font-medium">Laporan</span>
    </div>

    <!-- Page Heading & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em] print:text-black">Laporan Penyelesaian Tiket</h1>
            <p class="text-[#92a9c9] text-base font-normal print:text-gray-600">History of resolved issues and performance metrics.</p>
        </div>
        <button onclick="window.print()" class="flex items-center justify-center gap-2 rounded-lg h-10 px-5 bg-[#233348] hover:bg-[#324867] text-white text-sm font-bold transition-all print:hidden">
            <span class="material-symbols-outlined" style="font-size: 20px;">print</span>
            <span class="truncate">Cetak Laporan</span>
        </button>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 print:grid-cols-2 print:gap-4 print:mb-6">
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-[#233348] bg-[#1a232e] print:border-gray-300 print:bg-white">
            <div class="flex justify-between items-start">
                <p class="text-[#92a9c9] text-sm font-medium uppercase tracking-wider print:text-gray-600">Total Completed</p>
                <span class="material-symbols-outlined text-[#92a9c9] print:text-gray-400">check_circle</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-white text-3xl font-bold print:text-black">{{ $totalCompleted }}</p>
                <p class="text-emerald-400 text-sm font-medium print:text-emerald-600">Tickets resolved</p>
            </div>
        </div>
        <!-- Add more stats here if needed -->
    </div>

    <!-- Data Table -->
    <div class="rounded-xl border border-[#233348] overflow-hidden bg-[#1a232e] print:border-gray-300 print:bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-[#92a9c9] print:text-gray-800">
                <thead class="bg-[#233348] text-xs uppercase text-white font-semibold print:bg-gray-100 print:text-black">
                    <tr>
                        <th class="px-6 py-4 print:px-4 print:py-2">Date Resolved</th>
                        <th class="px-6 py-4 print:px-4 print:py-2">Subject</th>
                        <th class="px-6 py-4 print:px-4 print:py-2">User</th>
                        <th class="px-6 py-4 print:px-4 print:py-2">Resolution Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#233348] print:divide-gray-200">
                    @forelse($tickets as $ticket)
                    <tr class="hover:bg-[#233348]/50 transition-colors print:hover:bg-transparent">
                        <td class="px-6 py-4 print:px-4 print:py-2">
                            {{ $ticket->updated_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 print:px-4 print:py-2">
                            <span class="font-medium text-white print:text-black">{{ $ticket->subject }}</span>
                        </td>
                        <td class="px-6 py-4 print:px-4 print:py-2">
                            {{ $ticket->user->name }}
                        </td>
                        <td class="px-6 py-4 print:px-4 print:py-2">
                            {{ Str::limit($ticket->admin_response ?? 'No notes.', 50) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center print:px-4 print:py-2">No completed tickets found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="bg-[#1a232e] px-6 py-4 border-t border-[#233348] print:hidden">
            {{ $tickets->links() }}
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        .bg-\[\#111822\], .bg-\[\#1a232e\], .dark\:bg-background-dark {
            background-color: white !important;
        }
        .text-white, .dark\:text-white {
            color: black !important;
        }
        .border-\[\#233348\] {
            border-color: #e5e7eb !important; /* gray-200 */
        }
        /* Hide sidebar and other non-print elements */
        aside, header, footer {
            display: none !important;
        }
        /* Expand main content */
        main {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: auto !important;
            overflow: visible !important;
        }
        /* Ensure table prints nicely */
        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        th, td {
            border: 1px solid #ddd !important;
            padding: 8px !important;
        }
    }
</style>
@endsection
