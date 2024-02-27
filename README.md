# Controle de Séries

Este é um projeto de controle de séries desenvolvido em PHP utilizando o framework Laravel. Ele fornece uma API para gerenciar séries, temporadas e episódios, permitindo aos usuários acompanhar seu progresso de visualização.

## Rotas da API

### Autenticação
- **POST /login**
  - Rota para autenticar um usuário e gerar um token de acesso.
  - Parâmetros:
    - email (string): O email do usuário.
    - password (string): A senha do usuário.
  - Resposta:
    - 200 OK: Retorna o token de acesso.
    - 401 Unauthorized: Se as credenciais forem inválidas.

### Séries
- **GET /series**
  - Lista todas as séries.
- **GET /series/{id}**
  - Mostra detalhes de uma série específica.
- **POST /series**
  - Cria uma nova série.
  - Parâmetros:
    - title (string): O título da série.
    - description (string): A descrição da série.
- **PUT/PATCH /series/{id}**
  - Atualiza os detalhes de uma série.
- **DELETE /series/{id}**
  - Exclui uma série.

### Temporadas
- **GET /series/{series}/seasons**
  - Lista todas as temporadas de uma série específica.

### Episódios
- **GET /series/{series}/episodes**
  - Lista todos os episódios de uma série específica.
- **PATCH /episodes/{id}**
  - Atualiza o status de visualização de um episódio.
  - Parâmetros:
    - watched (boolean): Indica se o episódio foi assistido ou não.

## Autenticação
- As rotas de séries e episódios requerem autenticação via token.
- Para obter um token de acesso, envie uma solicitação POST para /login com o email e senha do usuário.
- Inclua o token de acesso nos cabeçalhos de todas as solicitações autenticadas como `Authorization: Bearer {token}`.

## Requisitos
- PHP >= 7.3
- Composer
- Laravel >= 8.0

## Instalação
1. Clone este repositório.
2. Execute `composer install` para instalar as dependências.
3. Configure o arquivo `.env` com as credenciais do banco de dados e outras configurações necessárias.
4. Execute `php artisan migrate` para migrar o banco de dados.
5. Execute `php artisan serve` para iniciar o servidor de desenvolvimento.

## Contribuindo
Contribuições são bem-vindas! Sinta-se à vontade para abrir um problema ou enviar um pull request.

## Licença
Este projeto é licenciado sob a [MIT License](LICENSE).