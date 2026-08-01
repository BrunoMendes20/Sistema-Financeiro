<x-layout-app page-title="Editar Transação">
    <x-form-card title="Editar Transação" back-route="{{ route('transactions.index') }}">
        <form action="{{ route('transactions.update', $transaction)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label"><strong>Descrição</strong></label>
                <input 
                    type="text"
                    name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    value="{{ old('description', $transaction->description)}}"
                    required
                    autofocus
                >
                <x-specific-alerts for="description" />
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Valor</strong></label>
                <input 
                    type="number"
                    name="amount"
                    step="0.01"
                    class="form-control @error('amount') is-invalid @enderror"
                    value="{{ old('amount', $transaction->amount)}}"
                    required
                >
                <x-specific-alerts for="amount" />
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Tipo</strong></label>
                <select 
                    name="type"
                    class="form-select @error('type') is-invalid @enderror"
                    required>
                    <option value="">Selecione...</option>
                    <option value="income" {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>Receita</option>
                    <option value="expense" {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>Despesa</option>
                </select>
                <x-specific-alerts for="type" />
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Categoria</strong></label>
                <select 
                    name="category_id"
                    class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">Sem Categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->type === 'income' ? 'Receita' : 'Despesa' }})
                        </option>
                    @endforeach
                </select>
                <x-specific-alerts for="category_id" />
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Data</strong></label>
                <input 
                    type="date"
                    name="date"
                    class="form-control @error('date') is-invalid @enderror"
                    value="{{ old('date', $transaction->date->format('Y-m-d'))}}"
                    required
                >
                <x-specific-alerts for="date" />    
            </div>



            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Atualizar Transação
                </button>
            </div>
        </form>
    </x-form-card>
</x-layout-app>