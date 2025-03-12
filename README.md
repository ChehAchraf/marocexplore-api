# MarocExplore API

A Laravel-based API for exploring Morocco's tourist destinations, culture, and experiences.

## Requirements

- PHP ^8.1
- Composer
- Laravel 10.x
- MySQL/PostgreSQL

## Installation

1. Clone the repository:
```bash
git clone https://github.com/ChehAchraf/marocexplore-api.git
cd marocexplore-api
```

2. Install dependencies:
```bash
composer install
```

3. Set up environment variables:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run migrations:
```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

## Features

- RESTful API endpoints
- Laravel Sanctum authentication
- Database migrations and seeders
- Comprehensive documentation

## Testing

Run the test suite using PHPUnit:
```bash
php artisan test
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.