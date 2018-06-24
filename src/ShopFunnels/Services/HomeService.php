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
     * Get current logged user name.
     *
     * @return mixed[]
     */
    public function getLoggedUser(): array
    {
        $currentUser = $this->userService->getLoggedUser();
        $username = $currentUser->getFirstname().' '.$currentUser->getLastname();

        return ['username' => $username];
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
            $store = $this->daoFactory->getStoreDao()->getValidStoresByName($storeName)->toArray()[0];
            $this->saveWorkingStore($store);
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
        $this->saveWorkingStore($store);
    }

    /**
     * Set working store of current logged user.
     *
     * @param Store $store
     * @return void
     */
    public function saveWorkingStore(Store $store): void
    {
        $currentUser = $this->userService->getLoggedUser();
        $currentUser->setWorkingStore($store);
        $this->daoFactory->getUserDao()->save($currentUser);
    }
}
