<?php 

namespace App\Services\AI\Prompts;

use App\Models\Category;

class CategoryPrompt
{
    public function build(string $description): string
    {
        $categories = Category::all(['id', 'name', 'type']);

        $categoryList = $categories->map(fn($c) => 
            "id: {$c->id}, nome: {$c->name}, tipo: {$c->type}"
        )->join("\n");

        return <<<PROMPT
            Você é um assistente financeiro. Com base na descrição da transação abaixo, 
            identifique qual categoria financeira melhor se encaixa.

            Descrição da transação: "{$description}"

            Categorias disponíveis:
            {$categoryList}

            Responda APENAS com um JSON no seguinte formato, sem explicações:
            {"category_id": <id da categoria mais adequada>}

            Se nenhuma categoria se encaixar, responda: {"category_id": null}
            PROMPT;

    }

}