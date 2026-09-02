# TheBoyzMarket

A local streetwear e-commerce store built with Laravel and Filament. Customers browse products, pick a size and color, checkout, and confirm their order instantly on WhatsApp. No online payment gateway. Payment is Cash on Delivery or manual bank transfer.

## Features

- Product catalog with categories, sizes (S to XXL), colors, and per-variant stock
- Cart and checkout (login required to place an order)
- Orders confirmed via a pre-filled WhatsApp message
- Order tracking by order number and phone
- Admin panel (Filament) for products, categories, orders, and store settings
- SEO: meta tags, Open Graph tags, sitemap.xml, robots.txt

## Requirements

- PHP 8.3+
- Composer
- MySQL
- Node.js and npm

## Setup

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

# Create a MySQL database named "theboyzmarket" (or update .env)

php artisan migrate --seed
php artisan storage:link

npm run build
php artisan serve
```

Update `.env` with your `STORE_WHATSAPP_NUMBER` and database credentials.

## Default Admin Login

- URL: `/admin`
- Email: `admin@theboyzmarket.com`
- Password: `password`

Change this password before going live.

## Tech Stack

- Laravel 12
- Filament 3 (admin panel)
- Laravel Breeze (customer auth)
- Tailwind CSS + Alpine.js
