# APIs REST com PHP 7 (Slim Framework)

Material do curso

* Autor: Jecé Xavier Pereira Neto
* E-mail: jece@alunos.utfpr.edu.br

## OBJETIVO

Desenvolver uma API REST com PHP 7 (Slim Framework) de um sistema.
Sistema criado foi uma plataforma de perguntas e respostas.
Para foi desenvolvido com o intuído de conhecer o Slim Framework.


## CONFIGURAÇÃO

Copie o arquivo `env.example.php` para `env.php` e preencha com as informações necessárias.

Rode no terminal `composer install` ou `php composer.phar install` dependendo de como você usa o composer.

Use os códigos no diretório `extra/` para criar o seu banco de dados trabalhando com o SGBD MySQL.

Use o arquivo `Insomnia_2020-10-20.json` diretório `extra/` para configurar o `Insomnia v4`.

## Rotas Criadas

### *Teste*: `/`;

* method: `get`


### *Login User*: `/login`;

* method: `post`
* No corpo da requisição deve conter:
  * `email`: `string`,
  * `password`: `string`

### *Create User*: `/users`;

* method: `post`
* No corpo da requisição deve conter:
  * `email`: `string`,
  * `password`: `string`
  * `passwordConfirmation`: `string`,
  * `name`: `string`

### *Update User*: `/users`;

* method: `put`
* No corpo da requisição deve conter:
  * `email`: `?string`,
  * `password`: `?string`
  * `passwordConfirmation`: `?string` (*Apenas obrigatório quando for alterar password*)
  * `name`: `?string`

### *Create Post*: `/posts`;

* method: `post`
*No corpo da requisição deve conter:
  * `doubt`: `string`
* No header da requisição deve conter:
  * `Authorization`: `token` (*Bearer Token*)

### *Listar Todos Posts*: `/posts`;

* method: `get`

### *Exibir Post*: `/posts/{postId}`;

* method: `get`
*No params da requisição deve conter:
  * `postId`: `string`

### *Create Comment*: `/comments`;

* method: `post`
*No corpo da requisição deve conter:
  * `commentDadId`: `string | null` (`null` é para quando ele é a resposta direta de um post)
  * `content`: `string`
  * `postId`: `string`
* No header da requisição deve conter:
  * `Authorization`: `token` (*Bearer Token*)

### *Delete Comment*: `/comments/{commentId}`;

* method: `delete`
*No params da requisição deve conter:
  * `commentId`: `string`
* No header da requisição deve conter:
  * `Authorization`: `token` (*Bearer Token*)

## Atualizações Futuras

[ ] Adicionar rota para Exibir User
[ ] Adicionar rota para atualizar avatar User
[ ] Refatorar Arquitetura
[ ] Padronizar retornos de erros
[ ] Adicionar ORM
[ ] Adicinar Depenicais Injection (Containers)


