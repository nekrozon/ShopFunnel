<?php

namespace ShopFunnels\Services;

use ShopFunnels\Dao\Generated\DaoFactory;
use TheCodingMachine\TDBM\TDBMException;
use PHPShopify\ShopifySDK;

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

    /**
     * Get products by shop name
     *
     * @param string $shop
     * @return mixed[]
     */
    public function getProducts(string $shop): array
    {
        $result = [
            'success' => true,
            'data' => [],
            'message' => ''
        ];

        $stores = $this->daoFactory->getStoreDao()->getValidStoresByName($shop)->toArray();
        if (empty($stores)) {
            $result['success'] = false;
            $result['message'] = 'You should authorize the store to get products.';
        } else {
            $store = $stores[0];
            $config = [
                'ShopUrl' => $store->getName(),
                'AccessToken' => $store->getAccessToken()
            ];
            $shopify = new ShopifySDK($config);
            $products = $shopify->Product->get();
            $result['data'] = $products;
        }

        return $result;
    }
}
