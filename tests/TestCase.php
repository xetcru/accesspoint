<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    /**
     * Метод, вызывающийся перед каждым тестом.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Убираем очистку базы данных, так как работаем с боевой базой
        // DB::table('users')->truncate(); // Эту строку можно оставить закомментированной
    }
}
