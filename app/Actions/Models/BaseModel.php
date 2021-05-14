<?php


namespace App\Actions\Models;


use App\Application;
use App\Components\DB\DB;
use App\Contracts\Models\ModelInterface;

class BaseModel implements ModelInterface
{
    public function save(string $key, $value = null)
    {
        if (empty($value)) {
            $value = $this;
        }
        Application::getInstance()->session()->set($key, $value);
        return $value;
    }

    public function __get($key)
    {
        return $this->{$key};
    }

    public function __set(string $key, int $value): void
    {
        $this->{$key} = $value;
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }
}