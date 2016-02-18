<?php
namespace Cgi\Application\Core;

/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 09.02.16
 * Time: 11:54
 */
interface OrmInterface
{
    public function set($field, $value);
    public function get($field);
    public function load($id);
    public function save();
    public function delete();
}
