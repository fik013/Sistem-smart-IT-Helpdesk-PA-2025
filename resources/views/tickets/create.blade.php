<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('New Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 animate-fade-in-up">
            <div class="glass-card">
                <h2 class="text-2xl font-bold text-white mb-6">Create Support Ticket</h2>
                <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-300 mb-2">Subject</label>
                        <input type="text" name="subject" class="w-full bg-white/5 border border-gray-600 rounded text-white focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-2">Description</label>
                        <textarea name="description" rows="5" class="w-full bg-white/5 border border-gray-600 rounded text-white focus:ring-blue-500" required placeholder="Describe what went wrong..."></textarea>
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-2">Upload Evidence (Optional)</label>
                        <input type="file" name="evidence" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700"/>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary">Submit Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
