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
     * @return bool;
     */
    public function phoneVerified($phone)
    {
        return $this->startConditions()
            ->select('phone_verified')
            ->where('phone', $phone);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function find($user_id)
    {
        return $this->startConditions()
            ->where('id', $user_id)->first();
    }
}
