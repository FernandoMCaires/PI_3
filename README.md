# API de E-commerce

Esta é a API de um sistema de e-commerce. A API permite o gerenciamento de usuários, produtos, categorias, carrinhos de compras, endereços e pedidos.

## Endpoints

### Autenticação

#### Registro de novo usuário
- URL: `/register`
- Método: `POST`
- Descrição: Registra um novo usuário.
- Parâmetros:
  - `name` (string): Nome do usuário.
  - `email` (string): Email do usuário.
  - `password` (string): Senha do usuário.

#### Login de usuário
- URL: `/login`
- Método: `POST`
- Descrição: Realiza o login do usuário.
- Parâmetros:
  - `email` (string): Email do usuário.
  - `password` (string): Senha do usuário.

#### Logout de usuário
- URL: `/logout`
- Método: `POST`
- Descrição: Realiza o logout do usuário.
- Middleware: `auth:api`

#### Retorna o usuário autenticado
- URL: `/user`
- Método: `GET`
- Descrição: Retorna os dados do usuário autenticado.
- Middleware: `auth:api`

### Produtos

#### Listar todos os produtos
- URL: `/produtos`
- Método: `GET`
- Descrição: Retorna uma lista de todos os produtos.

#### Exibir um produto específico
- URL: `/produtos/{id}`
- Método: `GET`
- Descrição: Retorna os detalhes de um produto específico.

### Categorias

#### Listar todas as categorias
- URL: `/categorias`
- Método: `GET`
- Descrição: Retorna uma lista de todas as categorias.

### Endereços

#### Gerenciamento de endereços
- URL: `/endereco`
- Método: `GET`, `POST`, `PUT`, `DELETE`
- Descrição: Endpoints para listar, criar, atualizar e deletar endereços.
- Middleware: `auth:api`

### Carrinho

#### Atualizar o carrinho
- URL: `/carrinho/atualiza`
- Método: `POST`
- Descrição: Adiciona ou atualiza um item no carrinho.
- Parâmetros:
  - `produto_id` (integer): ID do produto.
  - `quantidade` (integer): Quantidade do produto.
- Middleware: `auth:api`

#### Ver o carrinho
- URL: `/carrinho`
- Método: `GET`
- Descrição: Retorna os itens do carrinho do usuário autenticado.
- Middleware: `auth:api`

#### Remover item do carrinho
- URL: `/carrinho/remover/{produtoId}`
- Método: `DELETE`
- Descrição: Remove um item do carrinho.
- Middleware: `auth:api`

### Pedidos

#### Finalizar pedido
-  URL `/pedido/finalizar`
- Método: `POST`
- Descrição: Finaliza o pedido a partir dos itens do carrinho.
- Parâmetros:
  - `endereco_id` (integer): ID do endereço de entrega.
- Middleware: `auth:api`

## Listar pedidos do usuário
- URL: /pedidos
- Método: `GET`
- Descrição: Retorna uma lista de pedidos do usuário autenticado.
- Middleware: `auth:api`

## Instalação

1. Clone o repositório:
   ```sh
   git clone https://github.com/seu-usuario/seu-repositorio.git
   ```

2. Instale as dependências:
   ```sh
   composer install
   ```

3. Configure o arquivo `.env`:
   ```sh
   cp .env.example .env
   ```

4. Gere a chave da aplicação:
   ```sh
   php artisan key:generate
   ```

5. Configure o banco de dados no arquivo `.env`.

6. Execute as migrações:
   ```sh
   php artisan migrate
   ```

7. Inicie o servidor:
   ```sh
   php artisan serve
   ```

## Autenticação

A API utiliza autenticação via token JWT. Após o login, o token deve ser incluído no cabeçalho das requisições protegidas:

```sh
Authorization: Bearer {seu_token}
```

## Contribuição

1. Faça um fork do projeto.
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`).
3. Commit suas mudanças (`git commit -am 'Adiciona nova feature'`).
4. Faça o push para a branch (`git push origin feature/nova-feature`).
5. Crie um novo Pull Request.

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

