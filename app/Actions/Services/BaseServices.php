<?php


namespace App\Actions\Services;


use App\Contracts\Models\ModelInterface;

class BaseServices
{
    protected $model;

    public function __construct(ModelInterface $model)
    {
        $this->model = $model;
    }
}