<?php


namespace App\Actions\Repositories;


use App\Actions\Models\BaseModel;
use App\Actions\Policies\LeaguePolicy;
use App\Contracts\Repositories\RepositoryInterface;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public $policy;

    public function __construct(BaseModel $model)
    {
        $this->model = $model;
        $this->policy = new LeaguePolicy($this);


    }
}