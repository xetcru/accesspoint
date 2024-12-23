<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Full-stack Регистрация/Авторизация с использованием ReactJS и Laravel

## Описание

Этот проект представляет собой реализацию системы регистрации и авторизации с использованием **ReactJS** для фронтенда и **Laravel** для бэкенда. Реализованы все основные требования, включая валидацию данных, использование JWT-токенов для авторизации, а также автотесты для проверки функционала регистрации пользователей.

## Стек технологий

- **Frontend**: ReactJS
- **Backend**: Laravel
- **База данных**: MySQL (или другая на ваш выбор)
- **Авторизация**: JWT (JSON Web Tokens)
- **Автотесты**: PHPUnit (для Laravel)

## Особенности

- **Форма регистрации и авторизации** с валидацией:
  - Пароль должен содержать символы в разных регистрах и цифры.
  - Проверка обязательных полей (имя, email, пароль).
- **JWT-токены** для авторизации:
  - Генерация токена при успешной регистрации и логине.
  - Хранение токена в локальном хранилище браузера.
- **Автотесты**:
  - Тестирование процесса регистрации с валидацией данных.
  - Тестирование успешной и неуспешной авторизации.
  
## Установка

### 1. Клонирование репозитория

git clone https://github.com/xetcru/accesspoint.git
cd fullstack-auth-project

### 2. Установка зависимостей для бэкенда (Laravel)
Перейдите в папку с бэкендом и установите зависимости:
cd backend
composer install

Создайте .env файл, настроив подключение к базе данных:
cp .env.example .env
php artisan key:generate

### 3. Установка зависимостей для фронтенда (ReactJS)
Перейдите в папку с фронтендом и установите зависимости:
cd ../frontend
npm install

### 4. Запуск сервера
Бэкенд (Laravel):
php artisan serve

По умолчанию сервер будет доступен по адресу http://localhost:8000.

Фронтенд (ReactJS):
npm start

Фронтенд будет доступен по адресу http://localhost:3000.

### 5. Миграции
Для того чтобы настроить базу данных, выполните миграции:
php artisan migrate

## Структура проекта

### 1. Frontend (ReactJS)
- src/components: Компоненты для регистрации и авторизации.
- src/services: API-клиенты для работы с бэкендом (регистрация, авторизация).
- src/redux: Состояния и действия для управления авторизацией и пользовательскими данными.

### 2. Backend (Laravel)
- app/Http/Controllers/AuthController.php: Логика обработки запросов на регистрацию и авторизацию.
- app/Models/User.php: Модель пользователя с необходимыми правилами валидации.
- routes/api.php: Маршруты для регистрации и авторизации с использованием JWT.
- app/Providers/AuthServiceProvider.php: Настройки для работы с JWT.

## Как использовать

### 1. Регистрация пользователя:
- Перейдите на страницу регистрации в веб-приложении.
- Заполните форму с обязательными полями (имя, email, пароль).
- После успешной регистрации вы будете перенаправлены на страницу входа.

### 2. Авторизация пользователя:
- Введите email и пароль на странице авторизации.
- Если данные корректны, вы получите JWT-токен, который будет использован для дальнейших запросов к API.

### 3. API-интерфейс
- кроме веб-интерфейса предусмотрен веб-интерфейс для работы через Postman или схожее ПО

## Тесты

Для запуска автотестов на Laravel используйте команду:
php artisan test

Тесты будут проверять корректность регистрации пользователей, а также авторизацию с использованием JWT.

## Примечания
Для работы с JWT используется библиотека tymon/jwt-auth для Laravel.
Для фронтенда используется стандартный подход с ReactJS и Redux для управления состоянием.