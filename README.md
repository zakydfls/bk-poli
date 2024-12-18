[![Laravel Logo](https://laravel.com/img/logomark.min.svg)](https://laravel.com)

[![PHP](https://img.shields.io/badge/PHP-%3E%3D7.4-blue.svg)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-8.x-orange.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

Welcome to **BK-POLI**! This is a [Laravel](https://laravel.com) applicationW.

---

## Requirements

To run this project, ensure your environment meets the following requirements:

- PHP >= 8.0
- Composer >= 2.0
- Laravel >= 8.0
- MySQL/MariaDB or any supported database
- Node.js >= 16.x and NPM/Yarn for frontend assets

## Installation

Follow these steps to set up the project:

### 1. Clone the Repository

```bash
git clone https://github.com/zakydfls/bk-poli
cd bk-poli
```

### 2. Install Dependencies

Run the following command to install PHP dependencies:

```bash
composer install
```

### 2. Configure Environment

Duplicate the `.env.example` file and rename it to `.env`. Update the necessary values such as database connection:

```bash
cp .env.example .env
```

### 3. Generate Application Key

Run this command to generate the application key:

```bash
php artisan key:generate
```

### 4. Set Up the Database

Run migrations to set up the database:

```bash
php artisan migrate
```

(Optional) Seed the database:

```bash
php artisan db:seed
```

### 5. Serve the Application

Start the Laravel development server:

```bash
php artisan serve
```

Your application will be accessible at `http://localhost:8000`.

## Testing

Run tests to ensure everything is functioning correctly:

```bash
php artisan test
```

## Deployment

To deploy the application to a production environment, follow these steps:

1. Set the environment to `production` in the `.env` file:

   ```
   APP_ENV=production
   APP_DEBUG=false
   ```

2. Run the following commands:

   ```bash
   php artisan optimize
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. Ensure the web server is configured to point to the `public` directory.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your changes. Ensure your code follows the Laravel coding standards.

## License

This project is open-source and available under the [MIT License](LICENSE).

---

Thank you for using **BK-POLI**! If you have any questions, feel free to open an issue or contact us at [111202113316@mhs.dinus.ac.id].
