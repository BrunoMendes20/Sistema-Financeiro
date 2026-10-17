<?php 

namespace App\Services\AI\Prompts;


class ExpensePrompt
{
    public function build(array $transactions): string
    {
       
        $transactionList = collect($transactions)->map(fn($t) => 
            "- {$t['description']} | {$t['category']} | R$ {$t['amount']} | {$t['type']} | {$t['date']}"
        )->join("\n");

        return <<<PROMPT
            Você é um assistente financeiro pessoal especializado em análise de gastos.
            Analise as transações financeiras do mês abaixo e forneça:

            1. Um resumo geral das finanças do mês
            2. Os principais padrões de gastos identificados
            3. Categorias onde os gastos estão mais altos
            4. Sugestões práticas de economia
            5. Um alerta caso os gastos estejam próximos ou superiores às receitas

            Transações do mês:
            {$transactionList}

            Responda em português, de forma clara, objetiva e amigável.
            Use tópicos para organizar a resposta.
            PROMPT;
    }
}