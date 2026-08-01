<x-layout-app page-title="Transações">
    <x-form-card title="Transações" actionRoute="{{ route('transactions.create')}}" actionLabel="Nova Transação" actionIcon="bi-plus-lg">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Categoria</th>
                    <th>Data</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ number_format($transaction->amount, 2, ',', '.') }}</td>
                    <td>
                        @if($transaction->type === 'income')
                            <span class="badge bg-success">Receita</span>
                        @else
                            <span class="badge bg-danger">Despesa</span>
                        @endif
                    </td>
                    <td>{{ $transaction->category?->name ?? 'Sem Categoria' }}</td>
                    <td>{{ $transaction->date->format('d/m/Y') }}</td>
                    <td class="text-end">
                        @if($transaction->user_id === auth()->id())
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('transactions.destroy', $transaction)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @else
                            <span class="badge bg-secondary">Padrão</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Nenhuma transação encontrada.</td>  
                </tr>
                @endforelse
            </tbody>
        </table>
    </x-form-card>
</x-layout-app>