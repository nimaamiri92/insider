<?php


namespace App\Contracts\Components;


interface DBInterface
{
    public function get(string $key);

    public function set(string $key, $value);

    public function delete(string $key): bool;

    public function refresh(): bool;
}