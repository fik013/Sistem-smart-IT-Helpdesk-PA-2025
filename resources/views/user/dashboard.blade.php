<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Section -->
            <div class="glass-card text-center py-12 animate-fade-in-up">
                <div x-data="{ greetings: ['Selamat Datang', 'Welcome', 'Bienvenue', 'Hola', 'Konnichiwa', 'Willkommen'], current: 0 }" 
                     x-init="setInterval(() => current = (current + 1) % greetings.length, 3000)"
                     class="text-5xl font-extrabold mb-4">
                    <span x-text="greetings[current]" class="text-gradient transition-all duration-500 block h-16"></span>
                </div>
                <p class="text-xl text-gray-400">How can we help you today, {{ $user->name }}?</p>
            </div>

            <!-- Announcements -->
            @if($announcements->count() > 0)
            <div class="bg-blue-900/40 border-l-4 border-blue-500 p-4 rounded-r shadow-md animate-fade-in-up" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                        <p class="font-bold text-blue-200">Announcements</p>
                        @foreach($announcements as $announcement)
                            <p class="text-sm text-blue-300">{{ $announcement->content }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- AI Chatbot -->
                <div class="glass-card animate-fade-in-up" x-data="chatbot()">
                    <h3 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                        🤖 AI Technician
                    </h3>
                    <div class="h-64 overflow-y-auto bg-black/30 rounded-lg p-4 mb-4 space-y-3" id="chat-box">
                        <div class="text-gray-400 text-sm italic">AI Agent is ready. Ask about your inventory...</div>
                        <template x-for="msg in messages">
                            <div :class="msg.sender === 'user' ? 'text-right' : 'text-left'">
                                <span :class="msg.sender === 'user' ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-200'" class="inline-block px-3 py-2 rounded-lg text-sm max-w-[80%]">
                                    <span x-text="msg.text"></span>
                                </span>
                            </div>
                        </template>
                        <div x-show="loading" class="text-gray-500 text-xs animate-pulse">AI is typing...</div>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" x-model="userInput" @keydown.enter="sendMessage()" class="flex-1 bg-white/5 border border-gray-600 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Type a problem (e.g., 'Laptop broken')...">
                        <button @click="sendMessage()" class="btn-primary">Send</button>
                    </div>
                    <div x-show="showTicketSuggestion" class="mt-4 p-3 bg-yellow-900/30 border border-yellow-600 rounded text-center">
                        <p class="text-yellow-200 text-sm mb-2">Issue not resolved?</p>
                        <a href="{{ route('tickets.create') }}" class="text-yellow-400 hover:text-white underline font-semibold">Create Support Ticket</a>
                    </div>
                </div>

                <!-- Active Tickets -->
                <div class="glass-card animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-white">Active Tickets</h3>
                        <a href="{{ route('tickets.create') }}" class="text-sm text-blue-400 hover:text-blue-300 hover:underline">+ New Ticket</a>
                    </div>
                    @if($activeTickets->isEmpty())
                        <p class="text-gray-500 italic">No active tickets.</p>
                    @else
                        <div class="space-y-3">
                            @foreach($activeTickets as $ticket)
                                <div class="bg-white/5 p-3 rounded hover:bg-white/10 transition">
                                    <div class="flex justify-between">
                                        <span class="font-semibold text-gray-200">{{ $ticket->subject }}</span>
                                        <span class="text-xs px-2 py-1 rounded bg-yellow-500/20 text-yellow-300">{{ ucfirst($ticket->status) }}</span>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1 truncate">{{ $ticket->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Inventory -->
            <div class="glass-card animate-fade-in-up" style="animation-delay: 0.2s;">
                <h3 class="text-2xl font-bold text-white mb-4">My Inventory</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($inventories as $item)
                        <div class="bg-black/20 p-4 rounded-lg border border-white/5 hover:border-blue-500/50 transition">
                            <div class="text-lg font-semibold text-blue-300">{{ $item->item_name }}</div>
                            <div class="text-sm text-gray-400">{{ $item->description }}</div>
                            <div class="text-xs text-gray-500 mt-2">SN: {{ $item->serial_number ?? 'N/A' }}</div>
                        </div>
                    @endforeach
                </div>
                @if($inventories->isEmpty())
                    <p class="text-gray-500 italic text-center">No items assigned.</p>
                @endif
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('chatbot', () => ({
                messages: [],
                userInput: '',
                loading: false,
                showTicketSuggestion: false,

                async sendMessage() {
                    if (this.userInput.trim() === '') return;
                    
                    const text = this.userInput;
                    this.messages.push({ sender: 'user', text: text });
                    this.userInput = '';
                    this.loading = true;

                    // Scroll to bottom
                    this.$nextTick(() => {
                        const chatBox = document.getElementById('chat-box');
                        chatBox.scrollTop = chatBox.scrollHeight;
                    });

                    try {
                        const response = await axios.post('{{ route('chatbot.ask') }}', {
                            message: text
                        });

                        this.messages.push({ sender: 'ai', text: response.data.response });
                        if (response.data.suggest_ticket) {
                            this.showTicketSuggestion = true;
                        }
                    } catch (error) {
                        console.error(error);
                        this.messages.push({ sender: 'ai', text: 'Sorry, I encountered an error. Please try again.' });
                    } finally {
                        this.loading = false;
                        this.$nextTick(() => {
                            const chatBox = document.getElementById('chat-box');
                            chatBox.scrollTop = chatBox.scrollHeight;
                        });
                    }
                }
            }))
        })
    </script>
    @endpush
</x-app-layout>
