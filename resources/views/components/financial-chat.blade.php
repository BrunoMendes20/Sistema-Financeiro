<div class="mt-4">
    <x-form-card title="Chat Financeiro" >

        <div class="d-flex justfy-content-end mb-3">
            <form action="{{ route('chat.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja limpar o histórico do chat?')">
                    <i class="bi bi-trash"></i> Limpar Histórico
                </button>
            </form>
        </div>
        <div class="overflow-y-auto mb-3" style="height: 400px;" id="chatBox">
            @forelse ($history as $msg)
                <div class="d-flex {{ $msg['role'] === 'user' ? 'justify-content-end' : 'justify-content-start' }} mb-2">
                    <div class="p-3 rounded-3 {{ $msg['role'] === 'user' ? 'bg-primary text-white' : 'bg-light text-dark' }}" style="max-width: 75%;">
                        <small class="fw-bold d-block mb-1">
                            {{ $msg['role'] === 'user' ? 'Você' : 'Assistente' }}
                        </small>
                        {{ $msg['content'] }}
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="bi bi-chat-dots fs-1"></i>
                    <p class="mt-3">Nenhuma mensagem ainda. Faça uma pergunta sobre suas finanças.</p>
                </div>
            @endforelse
        </div>

        <form wire:submit="sendMessage">
            @csrf
            <div class="input-group">
                <input type="text" wire:model="message" class="form-control" placeholder="Pergunta algo sobre finanças..." wire:loading.attr="disabled">
                <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">
                    <span wire:loading wire:target="sendMessage">
                        <span class="spinner-border spinner-border-sm"></span>
                    </span>
                    <span wire:loading.remove wire:target="sendMessage">
                        <i class="bi bi-send"></i>
                    </span>
                </button>
              
            </div>
            @error('message')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </form> 
    </x-form-card>
    @script
        <script>
            $wire.on('scroll-to-bottom', () => {
                const chatBox = document.getElementById('chatBox');
                if(chat) chatBox.scrollTop = chatBox.scrollHeight;
            });
        </script>
    @endscript
</div>