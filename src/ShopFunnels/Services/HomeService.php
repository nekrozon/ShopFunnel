<?php

namespace ShopFunnels\Services;

use ShopFunnels\Dao\Generated\DaoFactory;
use Mouf\Security\UserService\UserService;
use TheCodingMachine\TDBM\TDBMException;
use ShopFunnels\Model\Store;

/**
 * HomeService Class
 */
class HomeService
{
    /**
     * @var DaoFactory
     */
    private $daoFactory;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * HomeController's constructor.
     * @param DaoFactory $daoFactory
     * @param UserService $userService
     */
    public function __construct(DaoFactory $daoFactory, UserService $userService)
    {
        $this->daoFactory = $daoFactory;
        $this->userService = $userService;
    }

    /**
     * Check if store already had been authorized or not.
     *
     * @param string $storeName
     * @return bool
     */
    public function verifyStore(string $storeName): bool
    {
        $count = $this->daoFactory->getStoreDao()->getValidStoresByName($storeName)->count();
        $success = $count > 0;
        if ($success) {
            $this->saveWorkingStore($storeName);
        }

        return $success;
    }

    /**
     * Save authorized store into db.
     *
     * @param string $storeName
     * @param string $accessToken
     * @return void
     */
    public function saveStore(string $storeName, string $accessToken): void
    {
        $store = new Store($storeName, $accessToken);
        $this->daoFactory->getStoreDao()->save($store);
        $this->saveWorkingStore($storeName);
    }

    /**
     * Set working store of current logged user.
     *
     * @param string $storeName
     * @return void
     */
    public function saveWorkingStore(string $storeName): void
    {
        $stores = $this->daoFactory->getStoreDao()->getValidStoresByName($storeName)->toArray();
        $currentStore = $stores[0];
        $currentUser = $this->userService->getLoggedUser();
        $currentUser->setWorkingStore($currentStore);
        $this->daoFactory->getUserDao()->save($currentUser);
    }
}
