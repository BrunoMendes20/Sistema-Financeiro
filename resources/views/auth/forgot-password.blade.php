<x-layout-guest page-title="Recuperar senha">
    <x-auth-card pageTitle="Recuperar senha">
        @if(!session('status'))
            <p>Para recuperar a sua senha, por favor indique o seu email. Você irá receber um email com um link para recuperação.</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label"> <strong>E-mail</strong></label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    <x-specific-alerts for='email' />
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('login') }}" class="text-decoration-none">Já sei a minha senha</a>
                    <button type="submit" class="btn btn-primary">
                        Enviar e-mail 
                    </button>
                </div>
            </form>
            
        @endif
    </x-auth-card>
</x-layout-guest>