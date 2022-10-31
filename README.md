# Laravel forum

This is a little "for-fun" app

Based on Laravel 9

## Installation

You can install this program by executing the following commands:

```bash
git clone https://github.com/MoroAlberto/laravel_forum.git
cd laravel_forum
composer install
npm install
cp .env.example .env
php artisan key:generate
docker-compose up -d
php artisan migrate
npm run dev
php artisan serve
```

After this, [go to localhost](http://127.0.0.1/) to update your forum
