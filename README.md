# Full Stack Vue Laravel Challenge

Base funcional de uma prova técnica Full Stack utilizando Laravel + MySQL e Vue 3, com uma aplicação de gerenciamento/listagem de compras de cursos.

## Estrutura

```
/api      Aplicação Laravel (API REST)
/web      Aplicação Vue 3 + Vite (frontend)
/docker   Dockerfile da API
```

## Pré-requisitos

- Docker
- Docker Compose
- Node.js
- npm

Não é necessário ter PHP ou Composer instalados na máquina para executar a API: tudo roda dentro do container.

## Backend (API)

1. Subir os containers:

   ```bash
   docker compose up -d --build
   ```

2. Copiar o arquivo de ambiente (caso ainda não exista):

   ```bash
   docker compose exec api cp .env.example .env
   ```

3. Instalar as dependências do Composer:

   ```bash
   docker compose exec api composer install
   ```

4. Gerar a chave da aplicação:

   ```bash
   docker compose exec api php artisan key:generate
   ```

5. Rodar as migrations e o seed:

   ```bash
   docker compose exec api php artisan migrate --seed
   ```

A API estará disponível em:

```
http://localhost:8000/api
```

> O MySQL fica acessível externamente em `localhost:3307` (porta interna do container continua sendo `3306`), útil para inspecionar o banco com um client local.

## Frontend

Executado **fora do Docker**, diretamente na máquina:

```bash
cd web
npm install
cp .env.example .env
npm run dev
```

A aplicação estará disponível em:

```
http://localhost:5173
```

## Endpoints

- `GET /api/customers`
- `GET /api/courses`
- `GET /api/purchases`
- `GET /api/purchases?status=pending|paid|canceled`

## Comandos úteis

Backend:

```bash
docker compose exec api php artisan migrate:fresh --seed
docker compose exec api php artisan test
docker compose logs api
docker compose logs db
docker compose down
docker compose down -v
```

Frontend:

```bash
cd web
npm run dev
npm run build
```
