<x-layout-app page-title="Nova Categoria">
    <x-form-card title="Nova Categoria" back-route="{{ route('categories.index') }}">
        <form action="{{ route('categories.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label"><strong>Nome</strong></label>
                <input 
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name')}}"
                    required
                    autofocus
                >
                <x-specific-alerts for="name" />
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Tipo</strong></label>
                <select 
                    name="type"
                    class="form-select @error('type') is-invalid @enderror"
                    required>
                    <option value="">Selecione...</option>
                    <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>Receita</option>
                    <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>Despesa</option>
                </select>
                <x-specific-alerts for="type" />
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">
                    Salvar Categoria
                </button>
            </div>
        </form>
                
    </x-form-card>
</x-layout-app>