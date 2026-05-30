<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="card-title text-center mb-4">
                        <i class="bi bi-wallet2>"></i>
                        @if ($pageTitle === 'Login')
                            Acesse sua conta
                        @elseif($pageTitle === 'Cadastrar')
                            Crie sua conta
                        @endif
                    </h4>

                    <x-general-alerts />

                    {{ $slot }}

                    <hr>

                    <p class="text-center mb-0 small">
                        {{ $footerLink }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
