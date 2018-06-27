<?php
declare(strict_types=1);

namespace ShopFunnels\Model\Generated;

use TheCodingMachine\TDBM\ResultIterator;
use TheCodingMachine\TDBM\AlterableResultIterator;
use Ramsey\Uuid\Uuid;
use ShopFunnels\Model\FunnelFormType;
use ShopFunnels\Model\Product;
use TheCodingMachine\TDBM\AbstractTDBMObject;

/*
 * This file has been automatically generated by TDBM.
 * DO NOT edit this file, as it might be overwritten.
 * If you need to perform changes, edit the FunnelForm class instead!
 */

/**
 * The AbstractFunnelForm class maps the 'funnel_forms' table in database.
 */
abstract class AbstractFunnelForm extends AbstractTDBMObject implements \JsonSerializable
{
    /**
     * The constructor takes all compulsory arguments.
     *
     * @param FunnelFormType $type
     * @param string $name
     */
    public function __construct(FunnelFormType $type, string $name)
    {
        parent::__construct();
        $this->setType($type);
        $this->setName($name);
        $this->setScriptLoaded(false);
        $this->setShowOrderTotal(false);
        $this->setReloadOnProductChange(false);
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->setUpdatedAt(new \DateTimeImmutable());
    }

    /**
     * The getter for the "id" column.
     *
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->get('id', 'funnel_forms');
    }

    /**
     * The setter for the "id" column.
     *
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->set('id', $id, 'funnel_forms');
    }

    /**
     * Returns the FunnelFormType object bound to this object via the type column.
     *
     * @return FunnelFormType
     */
    public function getType(): FunnelFormType
    {
        return $this->getRef('fk_funnel_forms_type', 'funnel_forms');
    }

    /**
     * The setter for the FunnelFormType object bound to this object via the type column.
     *
     * @param FunnelFormType $object
     */
    public function setType(FunnelFormType $object) : void
    {
        $this->setRef('fk_funnel_forms_type', $object, 'funnel_forms');
    }

    /**
     * The getter for the "name" column.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->get('name', 'funnel_forms');
    }

    /**
     * The setter for the "name" column.
     *
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->set('name', $name, 'funnel_forms');
    }

    /**
     * The getter for the "script_uri" column.
     *
     * @return string|null
     */
    public function getScriptUri() : ?string
    {
        return $this->get('script_uri', 'funnel_forms');
    }

    /**
     * The setter for the "script_uri" column.
     *
     * @param string|null $script_uri
     */
    public function setScriptUri(?string $script_uri) : void
    {
        $this->set('script_uri', $script_uri, 'funnel_forms');
    }

    /**
     * The getter for the "script_loaded" column.
     *
     * @return bool|null
     */
    public function getScriptLoaded() : ?bool
    {
        return $this->get('script_loaded', 'funnel_forms');
    }

    /**
     * The setter for the "script_loaded" column.
     *
     * @param bool|null $script_loaded
     */
    public function setScriptLoaded(?bool $script_loaded) : void
    {
        $this->set('script_loaded', $script_loaded, 'funnel_forms');
    }

    /**
     * The getter for the "purchase_button_label" column.
     *
     * @return string|null
     */
    public function getPurchaseButtonLabel() : ?string
    {
        return $this->get('purchase_button_label', 'funnel_forms');
    }

    /**
     * The setter for the "purchase_button_label" column.
     *
     * @param string|null $purchase_button_label
     */
    public function setPurchaseButtonLabel(?string $purchase_button_label) : void
    {
        $this->set('purchase_button_label', $purchase_button_label, 'funnel_forms');
    }

    /**
     * The getter for the "show_variants_button_label" column.
     *
     * @return string|null
     */
    public function getShowVariantsButtonLabel() : ?string
    {
        return $this->get('show_variants_button_label', 'funnel_forms');
    }

    /**
     * The setter for the "show_variants_button_label" column.
     *
     * @param string|null $show_variants_button_label
     */
    public function setShowVariantsButtonLabel(?string $show_variants_button_label) : void
    {
        $this->set('show_variants_button_label', $show_variants_button_label, 'funnel_forms');
    }

    /**
     * The getter for the "hide_variants_button_label" column.
     *
     * @return string|null
     */
    public function getHideVariantsButtonLabel() : ?string
    {
        return $this->get('hide_variants_button_label', 'funnel_forms');
    }

    /**
     * The setter for the "hide_variants_button_label" column.
     *
     * @param string|null $hide_variants_button_label
     */
    public function setHideVariantsButtonLabel(?string $hide_variants_button_label) : void
    {
        $this->set('hide_variants_button_label', $hide_variants_button_label, 'funnel_forms');
    }

    /**
     * The getter for the "show_order_total" column.
     *
     * @return bool|null
     */
    public function getShowOrderTotal() : ?bool
    {
        return $this->get('show_order_total', 'funnel_forms');
    }

    /**
     * The setter for the "show_order_total" column.
     *
     * @param bool|null $show_order_total
     */
    public function setShowOrderTotal(?bool $show_order_total) : void
    {
        $this->set('show_order_total', $show_order_total, 'funnel_forms');
    }

    /**
     * The getter for the "reload_on_product_change" column.
     *
     * @return bool|null
     */
    public function getReloadOnProductChange() : ?bool
    {
        return $this->get('reload_on_product_change', 'funnel_forms');
    }

    /**
     * The setter for the "reload_on_product_change" column.
     *
     * @param bool|null $reload_on_product_change
     */
    public function setReloadOnProductChange(?bool $reload_on_product_change) : void
    {
        $this->set('reload_on_product_change', $reload_on_product_change, 'funnel_forms');
    }

    /**
     * The getter for the "reloaded_at" column.
     *
     * @return \DateTimeImmutable|null
     */
    public function getReloadedAt() : ?\DateTimeImmutable
    {
        return $this->get('reloaded_at', 'funnel_forms');
    }

    /**
     * The setter for the "reloaded_at" column.
     *
     * @param \DateTimeImmutable|null $reloaded_at
     */
    public function setReloadedAt(?\DateTimeImmutable $reloaded_at) : void
    {
        $this->set('reloaded_at', $reloaded_at, 'funnel_forms');
    }

    /**
     * The getter for the "created_at" column.
     *
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt() : ?\DateTimeImmutable
    {
        return $this->get('created_at', 'funnel_forms');
    }

    /**
     * The setter for the "created_at" column.
     *
     * @param \DateTimeImmutable|null $created_at
     */
    public function setCreatedAt(?\DateTimeImmutable $created_at) : void
    {
        $this->set('created_at', $created_at, 'funnel_forms');
    }

    /**
     * The getter for the "updated_at" column.
     *
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt() : ?\DateTimeImmutable
    {
        return $this->get('updated_at', 'funnel_forms');
    }

    /**
     * The setter for the "updated_at" column.
     *
     * @param \DateTimeImmutable|null $updated_at
     */
    public function setUpdatedAt(?\DateTimeImmutable $updated_at) : void
    {
        $this->set('updated_at', $updated_at, 'funnel_forms');
    }

    /**
     * Returns the list of Product associated to this bean via the funnel_form_product pivot table.
     *
     * @return Product[]
     */
    public function getProducts() : array
    {
        return $this->_getRelationships('funnel_form_product');
    }
    /**
     * Adds a relationship with Product associated to this bean via the funnel_form_product pivot table.
     *
     * @param Product $product
     */
    public function addProduct(Product $product) : void
    {
        $this->addRelationship('funnel_form_product', $product);
    }
    /**
     * Deletes the relationship with Product associated to this bean via the funnel_form_product pivot table.
     *
     * @param Product $product
     */
    public function removeProduct(Product $product) : void
    {
        $this->_removeRelationship('funnel_form_product', $product);
    }
    /**
     * Returns whether this bean is associated with Product via the funnel_form_product pivot table.
     *
     * @param Product $product
     * @return bool
     */
    public function hasProduct(Product $product) : bool
    {
        return $this->hasRelationship('funnel_form_product', $product);
    }
    /**
     * Sets all relationships with Product associated to this bean via the funnel_form_product pivot table.
     * Exiting relationships will be removed and replaced by the provided relationships.
     *
     * @param Product[] $products
     */
    public function setProducts(array $products) : void
    {
        $this->setRelationships('funnel_form_product', $products);
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
        if (!$stopRecursion) {
            $object = $this->getType();
            $array['type'] = $object ? $object->jsonSerialize(true) : null;
        }
        $array['name'] = $this->getName();
        $array['scriptUri'] = $this->getScriptUri();
        $array['scriptLoaded'] = $this->getScriptLoaded();
        $array['purchaseButtonLabel'] = $this->getPurchaseButtonLabel();
        $array['showVariantsButtonLabel'] = $this->getShowVariantsButtonLabel();
        $array['hideVariantsButtonLabel'] = $this->getHideVariantsButtonLabel();
        $array['showOrderTotal'] = $this->getShowOrderTotal();
        $array['reloadOnProductChange'] = $this->getReloadOnProductChange();
        $array['reloadedAt'] = ($this->getReloadedAt() === null) ? null : $this->getReloadedAt()->format('c');
        $array['createdAt'] = ($this->getCreatedAt() === null) ? null : $this->getCreatedAt()->format('c');
        $array['updatedAt'] = ($this->getUpdatedAt() === null) ? null : $this->getUpdatedAt()->format('c');

        if (!$stopRecursion) {
            $array['products'] = array_map(function (Product $product) {
                return $product->jsonSerialize(true);
            }, $this->getProducts());
        }

        return $array;
    }

    /**
     * Returns an array of used tables by this bean (from parent to child relationship).
     *
     * @return string[]
     */
    protected function getUsedTables() : array
    {
        return [ 'funnel_forms' ];
    }

    /**
     * Method called when the bean is removed from database.
     *
     */
    protected function onDelete() : void
    {
        parent::onDelete();
        $this->setRef('fk_funnel_forms_type', null, 'funnel_forms');
    }
}
