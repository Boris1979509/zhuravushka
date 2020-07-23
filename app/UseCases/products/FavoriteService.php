<?php

namespace App\UseCases\products;

use App\Models\Shop\Product;
use App\Models\User;

class FavoriteService
{
    public function add($userId, $productId): void
    {
        $user = $this->getUser($userId);
        $product = $this->getProduct($productId);

        $user->addToFavorites($product->id);
    }

    public function remove($userId, $productId): void
    {
        $user = $this->getUser($userId);
        $product = $this->getProduct($productId);

        $user->removeFromFavorites($product->id);
    }

    private function getUser($userId): User
    {
        return User::findOrFail($userId);
    }

    private function getProduct($productId): Product
    {
        return Product::findOrFail($productId);
    }
}
