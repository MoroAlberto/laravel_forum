# Laravel forum

This is a little "for-fun" app

Based on:
- Laravel 13
- Tailwind CSS 4
- Vite 8
- Docker
- MySQL 8.4
- Alpine JS
- Laravel Breeze (Blade scaffolding)

## Technical Requirements

- PHP 8.5 or higher
- Composer 2
- Docker
- Node.js 20.19+ or 22.12+ with npm

## Installation

You can install this program by executing the following commands:

```bash
git clone https://github.com/MoroAlberto/laravel_forum.git
cd laravel_forum
composer install
npm install
cp .env.example .env
php artisan key:generate
docker compose up -d
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

After this, go to [localhost](http://127.0.0.1:8000/) to update your forum.

By default I create a user:
```bash
username: test@gmail.com
password: password
```
but the forum is also accessible by those who do not have a login.

## Tests

Tests run on an in-memory SQLite database, so no running MySQL is needed:

```bash
php artisan test
```

## Screenshot
![screenshot1.png](screenshot1.png)
