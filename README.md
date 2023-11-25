# Teste AutoConf

## Descrição

Este projeto é um sistema de gerenciamento de veículos desenvolvido em Laravel. Ele permite a criação, edição, exclusão e filtragem de veículos, associados a marcas e modelos.

## Funcionalidades

- Cadastro de veículos com informações como marca, modelo, ano, cor e preço.
- Associação de veículos a marcas e modelos.
- Filtragem de veículos por preço, marca e modelo.
- Edição e exclusão de veículos existentes.

## Pré-requisitos

- [PHP](https://www.php.net/) (versão 8.3)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (para gerenciamento de dependências front-end)
- [MySQL](https://www.mysql.com/) ou outro sistema de gerenciamento de banco de dados suportado por Laravel.

## Instalação

1. Clone o repositório: `git clone https://github.com/gabrifilla/teste_AutoConf.git`
2. Acesse o diretório do projeto: `cd teste_AutoConf`
3. Instale as dependências do Composer: `composer install`
4. Copie o arquivo de configuração `.env.example` para `.env` e configure suas variáveis de ambiente, especialmente as relacionadas ao banco de dados.
5. Execute as migrações do banco de dados: `php artisan migrate`
6. Execute as Seeds do banco de dados: `php artisan db:seed` (Caso não rode todas, rode separadamente com `php artisan db:seed--class=NomeDaSeeder`)
7. Inicie o servidor local com: `php artisan serve`

Acesse o aplicativo em `http://localhost:8000` no seu navegador.

## Uso

1. Acesse a aplicação no navegador.
2. Realize o login utilizando a conta de email - admin@example.com com senha 123 (após rodar as Seeds)
3. Cadastre novos veículos, associando-os a marcas e modelos existentes.
4. Utilize a funcionalidade de filtragem para encontrar veículos com base em critérios específicos.
5. Edite ou exclua veículos conforme necessário.