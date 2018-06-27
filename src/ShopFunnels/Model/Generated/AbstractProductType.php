<?php
declare(strict_types=1);

namespace ShopFunnels\Model\Generated;

use TheCodingMachine\TDBM\ResultIterator;
use TheCodingMachine\TDBM\AlterableResultIterator;
use Ramsey\Uuid\Uuid;
use ShopFunnels\Model\Product;
use TheCodingMachine\TDBM\AbstractTDBMObject;

/*
 * This file has been automatically generated by TDBM.
 * DO NOT edit this file, as it might be overwritten.
 * If you need to perform changes, edit the ProductType class instead!
 */

/**
 * The AbstractProductType class maps the 'product_types' table in database.
 */
abstract class AbstractProductType extends AbstractTDBMObject implements \JsonSerializable
{
    /**
     * The constructor takes all compulsory arguments.
     *
     * @param int $id
     * @param string $label
     */
    public function __construct(int $id, string $label)
    {
        parent::__construct();
        $this->setId($id);
        $this->setLabel($label);
    }

    /**
     * The getter for the "id" column.
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->get('id', 'product_types');
    }

    /**
     * The setter for the "id" column.
     *
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->set('id', $id, 'product_types');
    }

    /**
     * The getter for the "label" column.
     *
     * @return string
     */
    public function getLabel() : string
    {
        return $this->get('label', 'product_types');
    }

    /**
     * The setter for the "label" column.
     *
     * @param string $label
     */
    public function setLabel(string $label) : void
    {
        $this->set('label', $label, 'product_types');
    }

    /**
     * Returns the list of Product pointing to this bean via the type column.
     *
     * @return Product[]|AlterableResultIterator
     */
    public function getProducts() : AlterableResultIterator
    {
        return $this->retrieveManyToOneRelationshipsStorage('products', 'fk_products_type', 'products', ['products.type' => $this->get('id', 'product_types')]);
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
        $array['label'] = $this->getLabel();


        return $array;
    }

    /**
     * Returns an array of used tables by this bean (from parent to child relationship).
     *
     * @return string[]
     */
    protected function getUsedTables() : array
    {
        return [ 'product_types' ];
    }
}
