<?php

namespace ShopFunnels\Services;

use ShopFunnels\Model\Dao\Generated\DaoFactory;
use TheCodingMachine\TDBM\TDBMException;
use Mouf\Security\UserService\UserService;

/**
 * This class is responsible for handling User's Database persistence and objects
 */
class UserModelService
{
    protected $daoFactory;
    protected $userService;

    /**
     * @param DaoFactory $daoFactory
     * @param UserService $userService
     */
    public function __construct(DaoFactory $daoFactory, UserService $userService)
    {
        $this->daoFactory = $daoFactory;
        $this->userService = $userService;
    }
}
