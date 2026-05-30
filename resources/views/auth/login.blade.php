<x-layout-guest page-title="Login">
    <x-auth-card pageTitle="Login">

        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label"><strong>E-mail</strong></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autofocus>

                <x-specific-alerts for='email' />
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Senha</strong></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    required>

                <x-specific-alerts for='password' />
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
        <x-slot:footerLink>
            Não tem conta?
            <a href="{{ route('register') }}">Cadastre-se aqui</a>
        </x-slot:footerLink>
    </x-auth-card>
</x-layout-guest>
