<x-layout-app page-title="Dashboard">
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 small">Receitas do mês</p>
                            <h4 class="mb-0">R$ {{ number_format($totalIncome, 2, ',', '.') }}</h4>
                        </div>
                         <i class="bi bi-arrow-up-circle fs-1 opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 small">Despesas do mês</p>
                            <h4 class="mb-0">R$ {{ number_format($totalExpense, 2, ',', '.') }}</h4>
                        </div>
                        <i class="bi bi-arrow-down-circle fs-1 opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-white {{ $balance >= 0 ? 'bg-primary' : 'bg-warning' }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 small">Saldo do mês</p>
                            <h4 class="mb-0">R$ {{ number_format($balance, 2, ',', '.') }}</h4>
                        </div>
                        <i class="bi bi-wallet2 fs-1 opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">

        <div class="col-md-8">
            <x-form-card title="Últimas Transações">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ $transaction->category?->name ?? 'Sem categoria' }}</td>
                                <td>
                                    @if($transaction->type === 'income')
                                        <span class="text-success fw-bold">
                                            + R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-danger fw-bold">
                                            - R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $transaction->date->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Nenhuma transação encontrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </x-form-card>
        </div>

        <div class="col-md-4">
            <x-form-card title="Gastos por Categoria">
                @forelse($expensesByCategory as $category => $total)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small">{{ $category }}</span>
                        <span class="badge bg-danger">
                            R$ {{ number_format($total, 2, ',', '.') }}
                        </span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div
                            class="progress-bar bg-danger"
                            style="width: {{ $totalExpense > 0 ? ($total / $totalExpense) * 100 : 0 }}%">
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-4">Nenhum gasto este mês.</p>
                @endforelse
            </x-form-card>
        </div>
    </div>

</x-layout-app>