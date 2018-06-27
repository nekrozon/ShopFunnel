<?php
declare(strict_types=1);

namespace ShopFunnels\Model\Generated;

use TheCodingMachine\TDBM\ResultIterator;
use TheCodingMachine\TDBM\AlterableResultIterator;
use Ramsey\Uuid\Uuid;
use ShopFunnels\Model\ProductType;
use ShopFunnels\Model\VariantType;
use ShopFunnels\Model\VariantStyle;
use ShopFunnels\Model\FunnelForm;
use TheCodingMachine\TDBM\AbstractTDBMObject;

/*
 * This file has been automatically generated by TDBM.
 * DO NOT edit this file, as it might be overwritten.
 * If you need to perform changes, edit the Product class instead!
 */

/**
 * The AbstractProduct class maps the 'products' table in database.
 */
abstract class AbstractProduct extends AbstractTDBMObject implements \JsonSerializable
{
    /**
     * The constructor takes all compulsory arguments.
     *
     * @param ProductType $type
     * @param VariantType $variantType
     * @param VariantStyle $variantModelStyle
     * @param VariantStyle $variantColorStyle
     * @param VariantStyle $variantSizeStyle
     * @param string $shopifyId
     * @param string $name
     * @param string $clickFunnelName
     */
    public function __construct(ProductType $type, VariantType $variantType, VariantStyle $variantModelStyle, VariantStyle $variantColorStyle, VariantStyle $variantSizeStyle, string $shopifyId, string $name, string $clickFunnelName)
    {
        parent::__construct();
        $this->setType($type);
        $this->setVariantType($variantType);
        $this->setVariantModelStyle($variantModelStyle);
        $this->setVariantColorStyle($variantColorStyle);
        $this->setVariantSizeStyle($variantSizeStyle);
        $this->setShopifyId($shopifyId);
        $this->setName($name);
        $this->setClickFunnelName($clickFunnelName);
        $this->setExpandVariants(false);
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
        return $this->get('id', 'products');
    }

    /**
     * The setter for the "id" column.
     *
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->set('id', $id, 'products');
    }

    /**
     * Returns the ProductType object bound to this object via the type column.
     *
     * @return ProductType
     */
    public function getType(): ProductType
    {
        return $this->getRef('fk_products_type', 'products');
    }

    /**
     * The setter for the ProductType object bound to this object via the type column.
     *
     * @param ProductType $object
     */
    public function setType(ProductType $object) : void
    {
        $this->setRef('fk_products_type', $object, 'products');
    }

    /**
     * Returns the VariantType object bound to this object via the variant_type column.
     *
     * @return VariantType
     */
    public function getVariantType(): VariantType
    {
        return $this->getRef('fk_products_variant_type', 'products');
    }

    /**
     * The setter for the VariantType object bound to this object via the variant_type column.
     *
     * @param VariantType $object
     */
    public function setVariantType(VariantType $object) : void
    {
        $this->setRef('fk_products_variant_type', $object, 'products');
    }

    /**
     * Returns the VariantStyle object bound to this object via the variant_model_style column.
     *
     * @return VariantStyle
     */
    public function getVariantModelStyle(): VariantStyle
    {
        return $this->getRef('fk_products_variant_model_style', 'products');
    }

    /**
     * The setter for the VariantStyle object bound to this object via the variant_model_style column.
     *
     * @param VariantStyle $object
     */
    public function setVariantModelStyle(VariantStyle $object) : void
    {
        $this->setRef('fk_products_variant_model_style', $object, 'products');
    }

    /**
     * Returns the VariantStyle object bound to this object via the variant_color_style column.
     *
     * @return VariantStyle
     */
    public function getVariantColorStyle(): VariantStyle
    {
        return $this->getRef('fk_products_variant_color_style', 'products');
    }

    /**
     * The setter for the VariantStyle object bound to this object via the variant_color_style column.
     *
     * @param VariantStyle $object
     */
    public function setVariantColorStyle(VariantStyle $object) : void
    {
        $this->setRef('fk_products_variant_color_style', $object, 'products');
    }

    /**
     * Returns the VariantStyle object bound to this object via the variant_size_style column.
     *
     * @return VariantStyle
     */
    public function getVariantSizeStyle(): VariantStyle
    {
        return $this->getRef('fk_products_variant_size_style', 'products');
    }

    /**
     * The setter for the VariantStyle object bound to this object via the variant_size_style column.
     *
     * @param VariantStyle $object
     */
    public function setVariantSizeStyle(VariantStyle $object) : void
    {
        $this->setRef('fk_products_variant_size_style', $object, 'products');
    }

    /**
     * The getter for the "shopify_id" column.
     *
     * @return string
     */
    public function getShopifyId() : string
    {
        return $this->get('shopify_id', 'products');
    }

    /**
     * The setter for the "shopify_id" column.
     *
     * @param string $shopify_id
     */
    public function setShopifyId(string $shopify_id) : void
    {
        $this->set('shopify_id', $shopify_id, 'products');
    }

    /**
     * The getter for the "name" column.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->get('name', 'products');
    }

    /**
     * The setter for the "name" column.
     *
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->set('name', $name, 'products');
    }

    /**
     * The getter for the "image_uri" column.
     *
     * @return string|null
     */
    public function getImageUri() : ?string
    {
        return $this->get('image_uri', 'products');
    }

    /**
     * The setter for the "image_uri" column.
     *
     * @param string|null $image_uri
     */
    public function setImageUri(?string $image_uri) : void
    {
        $this->set('image_uri', $image_uri, 'products');
    }

    /**
     * The getter for the "click_funnel_name" column.
     *
     * @return string
     */
    public function getClickFunnelName() : string
    {
        return $this->get('click_funnel_name', 'products');
    }

    /**
     * The setter for the "click_funnel_name" column.
     *
     * @param string $click_funnel_name
     */
    public function setClickFunnelName(string $click_funnel_name) : void
    {
        $this->set('click_funnel_name', $click_funnel_name, 'products');
    }

    /**
     * The getter for the "custom_name_line1" column.
     *
     * @return string|null
     */
    public function getCustomNameLine1() : ?string
    {
        return $this->get('custom_name_line1', 'products');
    }

    /**
     * The setter for the "custom_name_line1" column.
     *
     * @param string|null $custom_name_line1
     */
    public function setCustomNameLine1(?string $custom_name_line1) : void
    {
        $this->set('custom_name_line1', $custom_name_line1, 'products');
    }

    /**
     * The getter for the "custom_name_line2" column.
     *
     * @return string|null
     */
    public function getCustomNameLine2() : ?string
    {
        return $this->get('custom_name_line2', 'products');
    }

    /**
     * The setter for the "custom_name_line2" column.
     *
     * @param string|null $custom_name_line2
     */
    public function setCustomNameLine2(?string $custom_name_line2) : void
    {
        $this->set('custom_name_line2', $custom_name_line2, 'products');
    }

    /**
     * The getter for the "min_quantity" column.
     *
     * @return int|null
     */
    public function getMinQuantity() : ?int
    {
        return $this->get('min_quantity', 'products');
    }

    /**
     * The setter for the "min_quantity" column.
     *
     * @param int|null $min_quantity
     */
    public function setMinQuantity(?int $min_quantity) : void
    {
        $this->set('min_quantity', $min_quantity, 'products');
    }

    /**
     * The getter for the "max_quantity" column.
     *
     * @return int|null
     */
    public function getMaxQuantity() : ?int
    {
        return $this->get('max_quantity', 'products');
    }

    /**
     * The setter for the "max_quantity" column.
     *
     * @param int|null $max_quantity
     */
    public function setMaxQuantity(?int $max_quantity) : void
    {
        $this->set('max_quantity', $max_quantity, 'products');
    }

    /**
     * The getter for the "expand_variants" column.
     *
     * @return bool|null
     */
    public function getExpandVariants() : ?bool
    {
        return $this->get('expand_variants', 'products');
    }

    /**
     * The setter for the "expand_variants" column.
     *
     * @param bool|null $expand_variants
     */
    public function setExpandVariants(?bool $expand_variants) : void
    {
        $this->set('expand_variants', $expand_variants, 'products');
    }

    /**
     * The getter for the "formatted_price" column.
     *
     * @return string|null
     */
    public function getFormattedPrice() : ?string
    {
        return $this->get('formatted_price', 'products');
    }

    /**
     * The setter for the "formatted_price" column.
     *
     * @param string|null $formatted_price
     */
    public function setFormattedPrice(?string $formatted_price) : void
    {
        $this->set('formatted_price', $formatted_price, 'products');
    }

    /**
     * The getter for the "created_at" column.
     *
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt() : ?\DateTimeImmutable
    {
        return $this->get('created_at', 'products');
    }

    /**
     * The setter for the "created_at" column.
     *
     * @param \DateTimeImmutable|null $created_at
     */
    public function setCreatedAt(?\DateTimeImmutable $created_at) : void
    {
        $this->set('created_at', $created_at, 'products');
    }

    /**
     * The getter for the "updated_at" column.
     *
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt() : ?\DateTimeImmutable
    {
        return $this->get('updated_at', 'products');
    }

    /**
     * The setter for the "updated_at" column.
     *
     * @param \DateTimeImmutable|null $updated_at
     */
    public function setUpdatedAt(?\DateTimeImmutable $updated_at) : void
    {
        $this->set('updated_at', $updated_at, 'products');
    }

    /**
     * Returns the list of FunnelForm associated to this bean via the funnel_form_product pivot table.
     *
     * @return FunnelForm[]
     */
    public function getFunnelForms() : array
    {
        return $this->_getRelationships('funnel_form_product');
    }
    /**
     * Adds a relationship with FunnelForm associated to this bean via the funnel_form_product pivot table.
     *
     * @param FunnelForm $funnelForm
     */
    public function addFunnelForm(FunnelForm $funnelForm) : void
    {
        $this->addRelationship('funnel_form_product', $funnelForm);
    }
    /**
     * Deletes the relationship with FunnelForm associated to this bean via the funnel_form_product pivot table.
     *
     * @param FunnelForm $funnelForm
     */
    public function removeFunnelForm(FunnelForm $funnelForm) : void
    {
        $this->_removeRelationship('funnel_form_product', $funnelForm);
    }
    /**
     * Returns whether this bean is associated with FunnelForm via the funnel_form_product pivot table.
     *
     * @param FunnelForm $funnelForm
     * @return bool
     */
    public function hasFunnelForm(FunnelForm $funnelForm) : bool
    {
        return $this->hasRelationship('funnel_form_product', $funnelForm);
    }
    /**
     * Sets all relationships with FunnelForm associated to this bean via the funnel_form_product pivot table.
     * Exiting relationships will be removed and replaced by the provided relationships.
     *
     * @param FunnelForm[] $funnelForms
     */
    public function setFunnelForms(array $funnelForms) : void
    {
        $this->setRelationships('funnel_form_product', $funnelForms);
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
        if (!$stopRecursion) {
            $object = $this->getVariantType();
            $array['variantType'] = $object ? $object->jsonSerialize(true) : null;
        }
        if (!$stopRecursion) {
            $object = $this->getVariantModelStyle();
            $array['variantModelStyle'] = $object ? $object->jsonSerialize(true) : null;
        }
        if (!$stopRecursion) {
            $object = $this->getVariantColorStyle();
            $array['variantColorStyle'] = $object ? $object->jsonSerialize(true) : null;
        }
        if (!$stopRecursion) {
            $object = $this->getVariantSizeStyle();
            $array['variantSizeStyle'] = $object ? $object->jsonSerialize(true) : null;
        }
        $array['shopifyId'] = $this->getShopifyId();
        $array['name'] = $this->getName();
        $array['imageUri'] = $this->getImageUri();
        $array['clickFunnelName'] = $this->getClickFunnelName();
        $array['customNameLine1'] = $this->getCustomNameLine1();
        $array['customNameLine2'] = $this->getCustomNameLine2();
        $array['minQuantity'] = $this->getMinQuantity();
        $array['maxQuantity'] = $this->getMaxQuantity();
        $array['expandVariants'] = $this->getExpandVariants();
        $array['formattedPrice'] = $this->getFormattedPrice();
        $array['createdAt'] = ($this->getCreatedAt() === null) ? null : $this->getCreatedAt()->format('c');
        $array['updatedAt'] = ($this->getUpdatedAt() === null) ? null : $this->getUpdatedAt()->format('c');

        if (!$stopRecursion) {
            $array['funnelForms'] = array_map(function (FunnelForm $funnelForm) {
                return $funnelForm->jsonSerialize(true);
            }, $this->getFunnelForms());
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
        return [ 'products' ];
    }

    /**
     * Method called when the bean is removed from database.
     *
     */
    protected function onDelete() : void
    {
        parent::onDelete();
        $this->setRef('fk_products_type', null, 'products');
        $this->setRef('fk_products_variant_type', null, 'products');
        $this->setRef('fk_products_variant_model_style', null, 'products');
        $this->setRef('fk_products_variant_color_style', null, 'products');
        $this->setRef('fk_products_variant_size_style', null, 'products');
    }
}
