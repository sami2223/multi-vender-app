# Mini Multi-Vendor Product Module (Laravel 12)

## Requirements
- PHP 8.3+, Composer, Node.js
- Database (MySQL)
- Mail driver (use MAIL_MAILER=log for local)

## Setup
```bash
composer install
cp .env.example .env
php artisan key:generate
# configure DB in .env
php artisan migrate
php artisan db:seed
composer dump-autoload
npm i && npm run build
php artisan serve

Login as admin: admin@example.com / password

Login as vendor: vendor@example.com / password