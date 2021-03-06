<?php
declare(strict_types=1);

namespace ShopFunnels\Model\Generated;

use TheCodingMachine\TDBM\ResultIterator;
use TheCodingMachine\TDBM\AlterableResultIterator;
use Ramsey\Uuid\Uuid;
use TheCodingMachine\TDBM\AbstractTDBMObject;

/*
 * This file has been automatically generated by TDBM.
 * DO NOT edit this file, as it might be overwritten.
 * If you need to perform changes, edit the Store class instead!
 */

/**
 * The AbstractStore class maps the 'stores' table in database.
 */
abstract class AbstractStore extends AbstractTDBMObject implements \JsonSerializable
{
    /**
     * The constructor takes all compulsory arguments.
     *
     * @param string $name
     * @param string $accessToken
     */
    public function __construct(string $name, string $accessToken)
    {
        parent::__construct();
        $this->setName($name);
        $this->setAccessToken($accessToken);
        $this->setAuthorizedDate(new \DateTimeImmutable());
        $this->setValid(true);
    }

    /**
     * The getter for the "id" column.
     *
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->get('id', 'stores');
    }

    /**
     * The setter for the "id" column.
     *
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->set('id', $id, 'stores');
    }

    /**
     * The getter for the "name" column.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->get('name', 'stores');
    }

    /**
     * The setter for the "name" column.
     *
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->set('name', $name, 'stores');
    }

    /**
     * The getter for the "access_token" column.
     *
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->get('access_token', 'stores');
    }

    /**
     * The setter for the "access_token" column.
     *
     * @param string $access_token
     */
    public function setAccessToken(string $access_token) : void
    {
        $this->set('access_token', $access_token, 'stores');
    }

    /**
     * The getter for the "authorized_date" column.
     *
     * @return \DateTimeImmutable
     */
    public function getAuthorizedDate() : \DateTimeImmutable
    {
        return $this->get('authorized_date', 'stores');
    }

    /**
     * The setter for the "authorized_date" column.
     *
     * @param \DateTimeImmutable $authorized_date
     */
    public function setAuthorizedDate(\DateTimeImmutable $authorized_date) : void
    {
        $this->set('authorized_date', $authorized_date, 'stores');
    }

    /**
     * The getter for the "valid" column.
     *
     * @return bool
     */
    public function getValid() : bool
    {
        return $this->get('valid', 'stores');
    }

    /**
     * The setter for the "valid" column.
     *
     * @param bool $valid
     */
    public function setValid(bool $valid) : void
    {
        $this->set('valid', $valid, 'stores');
    }

    /**
     * The getter for the "invalidated_date" column.
     *
     * @return \DateTimeImmutable|null
     */
    public function getInvalidatedDate() : ?\DateTimeImmutable
    {
        return $this->get('invalidated_date', 'stores');
    }

    /**
     * The setter for the "invalidated_date" column.
     *
     * @param \DateTimeImmutable|null $invalidated_date
     */
    public function setInvalidatedDate(?\DateTimeImmutable $invalidated_date) : void
    {
        $this->set('invalidated_date', $invalidated_date, 'stores');
    }


    /**
     * Serializes the object for JSON encoding.
     *
     * @param bool $stopRecursion Parameter used internally by TDBM to stop embedded objects from embedding other objects.
     * @return array
     */
    public function jsonSerialize($stopRecursion = false)
    {
        $array = [];
        $array['id'] = $this->getId();
        $array['name'] = $this->getName();
        $array['accessToken'] = $this->getAccessToken();
        $array['authorizedDate'] = $this->getAuthorizedDate()->format('c');
        $array['valid'] = $this->getValid();
        $array['invalidatedDate'] = ($this->getInvalidatedDate() === null) ? null : $this->getInvalidatedDate()->format('c');


        return $array;
    }

    /**
     * Returns an array of used tables by this bean (from parent to child relationship).
     *
     * @return string[]
     */
    protected function getUsedTables() : array
    {
        return [ 'stores' ];
    }
}
