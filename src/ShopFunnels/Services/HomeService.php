<?php

namespace ShopFunnels\Services;

use ShopFunnels\Dao\Generated\DaoFactory;
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
     * HomeController's constructor.
     * @param DaoFactory $daoFactory
     */
    public function __construct(DaoFactory $daoFactory)
    {
        $this->daoFactory = $daoFactory;
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

        return $count > 0;
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
    }
}
