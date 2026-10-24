# 💰 Sistema Financeiro com IA

Sistema de gestão financeira pessoal desenvolvido com PHP e Laravel, com integração de Inteligência Artificial via API do Google Gemini para categorização automática de transações, chat financeiro interativo e insights mensais por e-mail.

---

## 🚀 Funcionalidades

- **Autenticação completa** — cadastro, login, logout e recuperação de senha por e-mail
- **CRUD de categorias** — categorias padrão do sistema e personalizadas por usuário
- **CRUD de transações** — controle de receitas e despesas
- **Categorização automática com IA** — a IA analisa a descrição da transação e sugere a categoria automaticamente
- **Dashboard financeiro** — resumo de receitas, despesas, saldo e gastos por categoria
- **Chat financeiro com IA** — converse com a IA sobre suas finanças em tempo real
- **Insights mensais por e-mail** — análise financeira gerada pela IA enviada automaticamente todo mês
- **Proteção contra ataques** — rate limiting e throttle contra DDoS e força bruta

---

## 🛠️ Tecnologias utilizadas

| Tecnologia        | Versão    | Função                             |
| ----------------- | --------- | ---------------------------------- |
| PHP               | 8.5+      | Linguagem principal                |
| Laravel           | 13.x      | Framework back-end                 |
| Livewire          | 3.x       | Interatividade sem JavaScript      |
| Bootstrap         | 5.3       | Estilização                        |
| MySQL             | —         | Banco de dados                     |
| Google Gemini API | 2.0 Flash | Inteligência Artificial            |
| Mailtrap          | —         | Envio de e-mails (desenvolvimento) |

---

## 📋 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- [PHP 8.5+](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/)
- [Laragon](https://laragon.org/) (recomendado para Windows) ou outro servidor local
- [Node.js](https://nodejs.org/) (para compilar assets)
- Conta no [Google AI Studio](https://aistudio.google.com/) para obter a chave da API do Gemini
- Conta no [Mailtrap](https://mailtrap.io/) para receber e-mails em desenvolvimento

---

## ⚙️ Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/BrunoMendes20/Sistema-Financeiro
cd sistema-financeiro
```

### 2. Instale as dependências PHP

```bash
composer install
```

### 3. Instale as dependências JavaScript

```bash
npm install
npm run build
```

### 4. Configure o arquivo de ambiente

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure o `.env`

Abra o arquivo `.env` e ajuste as seguintes variáveis:

```env
APP_NAME=SistemaFinanceiro
APP_URL=http://sistema-financeiro.test

# Banco de dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_financeiro
DB_USERNAME=root
DB_PASSWORD=

# E-mail (Mailtrap)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_username_mailtrap
MAIL_PASSWORD=sua_senha_mailtrap
MAIL_FROM_ADDRESS=noreply@sistemafinanceiro.com
MAIL_FROM_NAME="Sistema Financeiro"

# Google Gemini API
GEMINI_API_KEY=sua_chave_aqui
```

### 6. Crie o banco de dados

No MySQL, crie um banco de dados com o nome `sistema_financeiro`:

```sql
CREATE DATABASE sistema_financeiro;
```

### 7. Execute as migrations e seeders

```bash
php artisan migrate --seed
```

O seeder cria automaticamente as categorias padrão do sistema (Alimentação, Salário, Lazer, etc.).

---

## ▶️ Como usar

### Iniciando o servidor

```bash
php artisan serve
```

Ou acesse diretamente pelo Laragon em `http://sistema-financeiro.test`.

### Cadastro e login

1. Acesse a aplicação no navegador
2. Clique em **Cadastre-se** e preencha nome, e-mail e senha
3. Após o cadastro, você será redirecionado para a tela de login
4. Faça login com suas credenciais

### Cadastrando transações

1. No menu superior, clique em **Transações**
2. Clique em **+ Nova Transação**
3. Preencha a descrição, valor, tipo (receita ou despesa) e data
4. Deixe a categoria em branco — **a IA categorizará automaticamente**
5. Clique em **Salvar Transação**

### Gerenciando categorias

1. No menu superior, clique em **Categorias**
2. As categorias padrão do sistema estão listadas com o badge **Padrão**
3. Para criar uma categoria personalizada, clique em **+ Nova Categoria**
4. Categorias personalizadas podem ser editadas e excluídas

### Usando o Chat com IA

1. Acesse o **Dashboard**
2. O chat financeiro está disponível no lado direito da tela
3. Digite sua pergunta e pressione Enter ou clique no botão enviar
4. Exemplos de perguntas:
    - _"Quanto gastei esse mês?"_
    - _"Onde posso economizar?"_
    - _"Estou gastando mais do que ganho?"_
    - _"Qual minha categoria com mais gastos?"_
5. Para limpar o histórico, clique em **Limpar histórico**

### Insights mensais por e-mail

O sistema envia automaticamente um e-mail com análise financeira gerada pela IA todo mês na data de aniversário do seu cadastro. Para testar manualmente:

```bash
php artisan tinker
```

```php
>>> $user = \App\Models\User::find(1);
>>> \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\MonthlyInsightsMail($user));
```

### Recuperação de senha

1. Na tela de login, clique em **Esqueceu a senha?**
2. Informe seu e-mail cadastrado
3. Acesse o Mailtrap e clique no link de redefinição
4. Defina uma nova senha

---

## 🔒 Segurança

- **Rate limiting** — máximo de 10 tentativas por minuto nas rotas POST de autenticação
- **RateLimiter** — bloqueio por 60 segundos após 5 tentativas de login inválidas
- **CSRF protection** — proteção em todos os formulários
- **Gate e Policies** — autorização para garantir que usuários só acessem seus próprios dados
- **Password hashing** — senhas armazenadas com hash bcrypt automático

---

## 📅 Scheduler (Envio automático de e-mails)

Para ativar o envio automático dos insights mensais, configure o cron job no servidor:

```bash
* * * * * cd /caminho/do/projeto && php artisan schedule:run >> /dev/null 2>&1
```

No Windows com Laragon, você pode rodar manualmente:

```bash
php artisan schedule:run
```

---

## 📂 Estrutura principal do projeto

```
app/
├── Http/
│   ├── Controllers/Auth/     → Login, cadastro, logout, recuperação de senha
│   ├── Controllers/          → Dashboard, categorias, transações
│   ├── Requests/             → Validações de formulários
│   └── Middleware/           → Middlewares personalizados
├── Livewire/                 → Componentes interativos (chat, dashboard)
├── Models/                   → User, Transaction, Category, AiInsight, ChatMessage
├── Services/AI/              → GeminiService, FinancialAnalysisService, Prompts
├── Jobs/                     → SendMonthlyInsights
├── Mail/                     → MonthlyInsightsMail
├── Notifications/            → CustomResetPassword
└── Policies/                 → CategoryPolicy, TransactionPolicy

resources/views/
├── auth/                     → Login, cadastro, recuperação de senha
├── categories/               → CRUD de categorias
├── transactions/             → CRUD de transações
├── components/               → Layouts, alertas, chat, dashboard
└── mail/                     → Templates de e-mail
```

---

## 🤖 Como a IA é utilizada

| Funcionalidade           | Quando é acionada                       |
| ------------------------ | --------------------------------------- |
| Categorização automática | Ao salvar uma transação sem categoria   |
| Chat financeiro          | A cada mensagem enviada no chat         |
| Insights mensais         | Todo mês na data de cadastro do usuário |

---

## 👨‍💻 Autor

Desenvolvido por **Bruno** — desenvolvedor back-end com foco em PHP e Laravel.

---

## 📄 Licença

Este projeto está sob a licença MIT.
