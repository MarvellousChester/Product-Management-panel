<?php
namespace Cgi\Application\Core;

class Settings
{
    static $settings = [
        'dbConnection' => [
            'dbname' => 'test_db',
            'host' => 'localhost',
            'user' => 'phpmyadmin',
            'password' => '123456'
        ]
    ];

    public static function getSettings($field)
    {
        return self::$settings[$field];
    }
}