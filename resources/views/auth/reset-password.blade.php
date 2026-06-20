<x-layout-guest page-title="Redefinir senha">
    <x-auth-card pageTitle="Redefinir senha">
       
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token}}">
            <input type="hidden" name="email" value="{{request('email')}}">

            <div class="mb-3">
                <label for="password" class="form-label"> </label> <strong>Definir nova senha</strong></label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autofocus>

              <x-specific-alerts for='password' />
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label"> <strong>Confirmar nova senha</strong></label>
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  required autofocus>

             <x-specific-alerts for='password_confirmation' />
            </div>

            <div class="col text-start"> 
                <button type="submit" class="btn btn-primary">
                    Redefinir Senha
                </button>

            </div>
            
            
        </form>

        <x-slot:footerLink >
            Lembrou sua senha?
            <a class="btn btn-link text-decoration-none" href="{{ route('login') }}">Clique aqui para fazer login</a>
        </x-slot:footerLink>
    </x-auth-card>
</x-layout-guest>