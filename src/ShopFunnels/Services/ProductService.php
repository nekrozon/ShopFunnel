<?php

namespace ShopFunnels\Services;

use ShopFunnels\Dao\Generated\DaoFactory;
use TheCodingMachine\TDBM\TDBMException;

/**
 * ProductService Class
 */
class ProductService
{
    /**
     * @var DaoFactory
     */
    private $daoFactory;

    /**
     * ProductService's constructor.
     * @param DaoFactory $daoFactory
     */
    public function __construct(DaoFactory $daoFactory)
    {
        $this->daoFactory = $daoFactory;
    }
}
