<?php

namespace App\UseCases\Products;

use App\Models\Shop\Product;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;

class FavoriteService
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository $productRepository
     */
    private $productRepository;

    /**
     * FavoriteService constructor.
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(UserRepository $userRepository, ProductRepository $productRepository)
    {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $userId
     * @param int $productId
     */
    public function add($userId, $productId): void
    {
        if ($product = $this->getProduct($productId)) {
            if ($user = $this->getUser($userId)) {
                $user->addToFavorites($product->id);
            } else {
                $this->notUserAuthFavorite($product);
            }
        }
    }

    public function remove($userId, $productId): void
    {
        if ($product = $this->getProduct($productId)) {
            if ($user = $this->getUser($userId)) {
                $user->removeFromFavorites($product->id);
            } else {
                $this->notUserAuthFavorite($product);
            }
        }
    }

    /**
     * @param Product $product
     */
    private function notUserAuthFavorite($product): void
    {
        $favorites = session('favorites', []);
        $index = array_search($product->id, $favorites, true);

        if ($index !== false) {
            unset($favorites[$index]);
        } else {
            $favorites[] = $product->id;
        }
        session(compact('favorites'));
    }

    /**
     * @param int $userId
     * @return User
     */
    private function getUser($userId): User
    {
        return $this->userRepository->find($userId);
    }

    /**
     * @param int $productId
     * @return Product
     */
    private function getProduct($productId): Product
    {
        return $this->productRepository->find($productId);
    }
}
