@props([
    'title' => null,
    'actionRoute' => null,
    'actionLabel' => null,
    'actionIcon'=> null,
    'backRoute' => null,
    'backLabel' => 'Voltar',

])

<div class="card shadow-sm">
    <div class="card-body p-4">
        @if($title || $actionRoute)
            <div class="d-flex justify-content-between align-items-center mb-4">
                @if($title)
                    <h4 class="mb-0">{{ $title }}</h4>
                @endif

                @if($backRoute)
                    <a href="{{ $backRoute }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i>
                        {{ $backLabel }}  
                    </a>
                @endif

                @if($actionRoute)
                    <a href="{{ $actionRoute }}" class="btn btn-primary btn-sm">
                        @if($actionIcon)
                            <i class="bi {{ $actionIcon }}"></i>
                        @endif
                        {{ $actionLabel }}
                    </a>
                @endif
            </div>
        @endif

        <x-general-alerts />

        {{ $slot ?? null }}
    </div>
</div>