<x-email-layout>

    <h3 style="color: #fff; margin-bottom: 16px;">
        Gastos Financeiros - {{ now()->format('m/Y') }}
    </h3>

    <p style="color:#ccc;">
        Olá, <strong style="color:#fff;">{{ $user->name }}</strong>!
    </p>

    <p style="color:#ccc;">
        Aqui está o resummo financeiro do seu mês gerado pela nossa IA:
    </p>

    <div style="background:#1e293b; border-radius: 8px; padding:16px; margin:16px 0;">
        <p style="color:#e2e8f0; white-space: pre-line;">
            {!! \Illuminate\Support\Str::markdown($insights) !!}
        </p>
    </div>

    <p style="color:#ccc;">
        Acesse o sistema para ver mais detalhes e conversar com o nosso assistente financeiro.
    </p>

    <p style="color:#ccc;">
        Atenciosamente, <br>
        <strong style="color:#fff;">Equipe {{ config('app.name') }} </strong>
</x-email-layout>