<?php


namespace App\Repositories;

use App\Models\User as Model;

class UserRepository extends CoreRepository
{

    /**
     * Возвращает полное имя класса
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
