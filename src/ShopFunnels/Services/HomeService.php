<?php

namespace ShopFunnels\Services;

use ShopFunnels\Dao\Generated\DaoFactory;
use TheCodingMachine\TDBM\TDBMException;

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
     */
    public function verifyStore(string $storeName)
    {
        $count = $this->daoFactory->getStoreDao()->getValidStoresByName($storeName)->count();

        return $count > 0;
    }
}
