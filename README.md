# Laravel forum

This is a little "for-fun" app

Based on Laravel 9

## Technical Requirements

•   PHP 8.0 or higher <br>
•	Composer installed <br>

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
php artisan db:seed
npm run dev
php artisan serve
```

After this, [go to localhost](http://127.0.0.1/) to update your forum.
To start you can use user test@gmail.com with password password
