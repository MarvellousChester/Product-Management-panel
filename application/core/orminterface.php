<?php
namespace Cgi\Application\Core;


interface OrmInterface
{
    public function set($field, $value);
    public function get($field);
    public function loadBy($field, $value);
    public function save();
    public function delete();
}
