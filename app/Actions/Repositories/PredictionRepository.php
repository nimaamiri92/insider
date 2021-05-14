<?php


namespace App\Actions\Repositories;


use App\Actions\Models\Prediction;

class PredictionRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Prediction);
    }


}