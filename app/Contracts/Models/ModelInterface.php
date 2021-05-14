<?php


namespace App\Contracts\Models;


interface ModelInterface
{
    public function __get($key);

    public function __set(string $key, int $value): void;

    public function save(string $key, $value = null);

    public function getTableName(): string;
}