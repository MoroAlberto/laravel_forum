# Laravel Forum

A small forum built for fun with Laravel 13: write posts, filter them by topic, comment and like.

![Laravel Forum screenshot](screenshot1.png)

## Features

- **Posts** grouped by type (e.g. *Food*, *Games*), with pagination and filtering by type
- **Comments** and **likes**, one like per user per post
- **Guests can read**, only logged users can write, and only the author can edit or delete a post
- **Admin-only user creation**: there is no public sign-up, admins create the accounts
- **English and Italian**, picked from the browser language or the switcher in the navbar
- **Rate limiting** on posts, comments and likes against spam

## Tech stack

| Layer    | Tools                                              |
|----------|----------------------------------------------------|
| Backend  | PHP 8.5, Laravel 13, MySQL 8.4                     |
| Frontend | Blade (Breeze scaffolding), Tailwind CSS 4, Alpine.js, Vite 8 |
| Tooling  | Laravel Sail (Docker), PHPUnit, Larastan, Pint     |

## Getting started

The only requirement is **Docker with Docker Compose**: PHP, Composer, Node.js and MySQL
all run in the containers provided by [Laravel Sail](https://laravel.com/docs/sail).

```bash
git clone https://github.com/MoroAlberto/laravel_forum.git
cd laravel_forum
cp .env.example .env

# install the PHP dependencies, Sail included
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/app" -w /app \
    composer:2 composer install --ignore-platform-reqs

./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

Then open [localhost:8080](http://localhost:8080) and log in with the seeded **admin** account:

| Email            | Password   |
|------------------|------------|
| `test@gmail.com` | `password` |

Stop the containers with `./vendor/bin/sail down`.

> **Tip:** add `alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'` to your shell
> profile to type `sail` instead of `./vendor/bin/sail`.

## Development

```bash
./vendor/bin/sail npm run dev    # Vite dev server with hot reload
```

### Configuration

The main settings live in `.env`:

| Variable          | Default | Description                               |
|-------------------|---------|-------------------------------------------|
| `APP_PORT`        | `8080`  | Port of the web application               |
| `VITE_PORT`       | `5174`  | Port of the Vite dev server               |
| `FORWARD_DB_PORT` | `3307`  | MySQL port reachable from the host        |
| `APP_LOCALE`      | `en`    | Language used when the browser's one isn't supported |

### Translations

Strings live in `lang/en` and `lang/it` (`message.php` for the forum, `it.json` for the
Breeze and pagination strings). To add a language, create its files in `lang/` and add it
to `SetLocale::LOCALES` in `app/Http/Middleware/SetLocale.php`.

## Quality checks

Tests run on a separate `testing` MySQL database created by Sail, so the containers must be running.

```bash
./vendor/bin/sail test                # PHPUnit
./vendor/bin/sail composer analyse    # Larastan, level 8
./vendor/bin/sail pint                # code style
```

## License

Released under the [MIT license](LICENSE): feel free to copy and reuse it.
