<x-layout-guest page-title="Cadastrar">
    <x-auth-card pageTitle="Cadastrar">
        <form action="{{ route('register.store') }}" method="POST">


            <div class="mb-3">
                <label class="form-label"><strong>Nome</strong></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required autofocus>

                <x-specific-alerts for='name' />
            </div>

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

            <div class="mb-3">
                <label class="form-label"><strong>Confirmar Senha</strong></label>
                <input type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror" required>

                <x-specific-alerts for='password_confirmation' />

            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
        <x-slot:footerLink>
            Já tem conta?
            <a href="{{ route('login') }}">Faça login</a>
        </x-slot:footerLink>
    </x-auth-card>
</x-layout-guest>
