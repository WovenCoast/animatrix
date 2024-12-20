# Animatrix

An anime related blog, rating only the best shows of Japanese anime

## Prerequisites

Make sure your system has the following installed
- PHP 8.3.14
- Laravel Framework 11.36.1
- Node.js v23.1.0
- MySQL 8.0
- Composer
- Git

> This project will most likely work with newer versions, no guarantees though

## Installation

To get started with this project, clone this GitHub repository
```shell
git clone git@github.com:WovenCoast/animatrix.git
cd animatrix
```

Install dependencies
```shell
composer install
npm install
```

### Configuration

Ensure that the extensions `pdo_mysql` and `gd` are enabled in the `php.ini` file.

To configure your environment, start by first copying the example env file provided.
```shell
cp .env.example .env
```

Configure your .env with your database credentials
```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=animatrix
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
> Make sure to create the database "animatrix" in mysql 

Generate the app keys and run all migrations
```shell
php artisan key:generate
php artisan migrate
```
> If the migrate command fails, recheck your database credentials

To start up the development server, simply run
```shell
composer run dev
```

## Contributing

You can run the tests with 
```shell
composer test
```
