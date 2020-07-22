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

    /**
     * @param string $phone
     */
    public function phoneVerified($phone){
        $this->startConditions()
            ->select('phone_verified')
            ->where('phone', $phone);
    }
}
