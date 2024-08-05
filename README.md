# Student Enrollment

Sistema de matrícula de alunos desenvolvido com Laravel e Livewire.

## Features

-   Gerenciamento de alunos
-   Gerenciamento de turmas
-   Matrícula de alunos em turmas

## Tecnologias utilizadas

-   PHP 8.3
-   Laravel 11
-   Livewire 3
-   Laravel Breeze
-   Pest
-   MySql

## Requerimentos

Necessário sistema operacional macOS, Linux ou Windows (via [WSL2](https://docs.microsoft.com/en-us/windows/wsl/about)) e Docker.

## Rodando localmente

Clone o projeto

```bash
  git clone https://github.com/dandevweb/student-enrollment.git

```

Entre no diretório do projeto

```bash
  cd student-enrollment

```

Crie o arquivo .env a partir do arquivo .env.example

```bash
  cp .env.example .env
```

Com o Docker "startado", suba o container

```bash
  docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

Inicie o servidor

```bash
  ./vendor/bin/sail up -d
```

Crie um alias para facilitar os comandos do Sail

```bash
  alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Gere a chave da aplicação

```bash
  sail artisan key:generate
```

Execute as migrations

```bash
  sail artisan migrate
```

Execute os seeders

```bash
  sail artisan db:seed
```

Instale as dependências javascript

```bash
  sail npm install
```

Compile os assets

```bash
  sail npm run dev
```

Acesse o projeto em:

    - http://localhost

## Testes

Para rodar os testes, execute o comando:

```bash
  sail test
```

## Usuários

-   **Secretaria**

    -   E-mail: secretaria@example.com
    -   Senha: password

-   **Assistente**

    -   E-mail: assistente@example.com
    -   Senha: password

-   **Cadastro**
    -   E-mail: cadastro@example.com
    -   Senha: password

## Libs utilizadas

**PHP composer**

-   [laravel-pt-BR-localization](https://github.com/lucascudo/laravel-pt-BR-localization)

-   [Blade Heroicons](https://github.com/blade-ui-kit/blade-heroicons)

-   [Livewire Modal](https://github.com/wire-elements/modal)

-   [Livewire Alert](https://github.com/jantinnerezo/livewire-alert)

**JS npm**

-   [SortableJS](https://sortablejs.github.io/Sortable/)
