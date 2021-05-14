<?php
namespace App\Components\Session;

interface SessionInterface
{
    public function start();

    public function delete();

    public function save();

    public function set($name, $value);

    public function unset($name);

    public function get($name);

}

?>