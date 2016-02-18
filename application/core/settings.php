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
        ],
        'magentoInputFields' => [
            'name',
            'sku',
            'is_saleable',
            'description',
            'final_price_without_tax'
        ],

    ];

    public static function getSettings($field)
    {
        return self::$settings[$field];
    }
}