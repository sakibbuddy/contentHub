# ContentHub Setup & Installation Guide

Welcome to ContentHub! Follow these steps to set up and run the project locally.

---

## Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- SQLite

---

## 1. Clone the Repository
```
git clone https://github.com/sakibbuddy/contentHub.git
cd ContentsHub
```

## 2. Install PHP Dependencies
```
composer install
```

## 3. Install Node.js Dependencies
```
npm install
```

## 4. Copy & Configure Environment File
```
cp .env.example .env
```
- Edit `.env` and set your database and mail credentials.

## 5. Generate Application Key
```
php artisan key:generate
```

## 6. Run Migrations & Seeders
```
php artisan migrate --seed
```

## 7. Build Frontend Assets
```
npm run build
```

## 8. Start the Development Server
```
php artisan serve
```
Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## Additional Commands
- **Run tests:**
  ```
  php artisan test
  ```
- **Run in watch mode (frontend):**
  ```
  npm run dev
  ```


---
Credentials
username: john@doe.com
password: Test@12345

---

## Troubleshooting
- If you see permission errors, try:
  ```
  chmod -R 775 storage bootstrap/cache
  ```
- For more info, see the [Laravel documentation](https://laravel.com/docs/12.x/installation).

---

---

Happy coding!
