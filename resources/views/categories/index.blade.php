<x-layout-app page-title="Categorias">
   <x-form-card title="Categorias" actionRoute="{{ route('categories.create')}}" actionLabel="Nova Categoria" actionIcon="bi-plus-lg">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if($category->type === 'income')
                            <span class="badge bg-success">Receita</span>
                        @else
                            <span class="badge bg-danger">Despesa</span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if($category->user_id === auth()->id())
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category)}}" method="POST" class="d-inline">
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
                    <td colspan="3" class="text-center text-muted py-4">Nenhuma categoria encontrada.</td>  
                </tr>
                @endforelse
            </tbody>
        </table>
   </x-form-card>
    
</x-layout-app>