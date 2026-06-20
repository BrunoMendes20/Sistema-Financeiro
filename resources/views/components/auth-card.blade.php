<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="card-title text-center mb-4">
                        <i class="bi bi-wallet2"></i>

                    {{-- Foi utilizado um array para mapear os títulos das páginas, pois não tem lógica nenhuma além de exibi-los --}}
                    {{[
                        'Login' => 'Acesse sua conta',
                        'Cadastrar' => 'Crie sua conta',
                        'E-mail enviado' => 'E-mail Enviado',
                        'Recuperar senha' => 'Recuperar sua senha',
                        'Redefinir senha' => 'Redefinir sua Senha'
                    ][$pageTitle] ?? $pageTitle }}
                    </h4>

                    <x-general-alerts />

                    {{ $slot ?? null }}

                    <hr>

                    <p class="text-center mb-0 small">
                        {{ $footerLink ?? null }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
