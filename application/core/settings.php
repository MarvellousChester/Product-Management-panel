<?php
namespace Cgi\Application\Core;

class Settings
{
    private static $settings = [
        'dbConnection' => [
            'dbname' => 'test_db',
            'host' => 'localhost',
            'user' => 'phpmyadmin',
            'password' => '123456'
        ],
        'productsPerPage' => '10',

        'guestActionsList' => [
            'actionlogin'
        ],

        'unAuthRedirectPage' => 'http://pmpanel.loc/main/login'

    ];

    public static function getSettings($field)
    {
        return self::$settings[$field];
    }
}