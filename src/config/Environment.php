<?php

namespace Config;

use Dotenv\Dotenv;

class Environment
{
    public static function loadEnvironment()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::loadEnvironment();
        return $_ENV[$key] ?? $default;
    }
}
