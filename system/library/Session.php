<?php

namespace Library;

class Session
{
    public static function init(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function isLogged(): bool
    {
        self::init();

        return isset($_SESSION['user']);
    }

    public static function getLoggedUser(): array
    {
        self::init();

        return (self::isLogged()) ? $_SESSION['user'] : [];
    }

    public static function login(array $user): void
    {
        self::init();

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];

        header('location: /');
        exit;
    }

    public static function logout(): void
    {
        self::init();

        unset($_SESSION['user']);

        header('location: /user/login');
        exit;
    }

    public static function requireLogin(): void
    {
        if (!self::isLogged()) {
            header('location: /user/login');
            exit;
        }
    }

    public static function requireLogout(): void
    {
        if (self::isLogged()) {
            header('location: /');
            exit;
        }
    }
}
