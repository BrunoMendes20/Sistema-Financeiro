<x-layout-guest page-title="E-mail enviado">
    <x-auth-card pageTitle="E-mail enviado">
        <p class="display-6 text-center">Verifique seu email</p>
        <p class="mt-3">Um link de redefinição de senha foi enviado para o seu endereço de email, se ele estiver registrado em nossa plataforma. Por favor, verifique sua caixa de entrada e siga as instruções para redefinir sua senha.</p>
        <x-slot:footerLink>
            Lembrou sua senha?
            <a href="{{ route('login') }}">Clique aqui para fazer login</a>
        </x-slot:footerLink>
    </x-auth-card>
</x-layout-guest>