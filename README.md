<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project Laravel Simple Task
#### Laravel Version : 8.75
#### Database Name : task_db

## Install Project
- git clone https://github.com/BayuM26/simple_task.git
- cd simple_task/
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate --seed (Seed data Random data menggunakan faker untuk mengisi database)

## Install Json Web Token (JWT) for project
- php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
- php artisan jwt:secret

## Running Project
- php artisan serve

## User Tetap Untuk Login
**Hak Akses : admin**
- username : admin
- password : admin

**Hak Akses : Employee**
- username : bayu
- password : bayu

**Hak Akses : Employee**
- username : maulana
- password : maulana

## API
Login untuk mendapatkan bearer token untuk dapat mengakses data

#### **Login dan Logout**
- http://127.0.0.1:8000/api/login
- http://127.0.0.1:8000/api/logout

**Refresh token**
- http://127.0.0.1:8000/api/refresh

**get data profile**
- http://127.0.0.1:8000/api/me

**get Data Task**
- http://127.0.0.1:8000/api/getTask

**get Data Category**
- http://127.0.0.1:8000/api/getCategory

**get Data User**
- http://127.0.0.1:8000/api/getUser
