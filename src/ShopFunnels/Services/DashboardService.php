<?php

namespace ShopFunnels\Services;

use ShopFunnels\Dao\Generated\DaoFactory;
use Mouf\Security\UserService\UserService;
use PHPShopify\ShopifySDK;
use TheCodingMachine\TDBM\TDBMException;
use PHPShopify\Exception\ApiException;
use ShopFunnels\Classes\ExceptionMessages;
use ShopFunnels\Classes\ErrorCodes;

/**
 * DashboardService Class
 */
class DashboardService
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
     * DashboardService's constructor.
     * @param DaoFactory $daoFactory
     * @param UserService $userService
     */
    public function __construct(DaoFactory $daoFactory, UserService $userService)
    {
        $this->daoFactory = $daoFactory;
        $this->userService = $userService;
    }

    /**
     * Get init data for dashboard page.
     *
     * @return mixed[]
     */
    public function getInitData(): array
    {
        $currentUser = $this->userService->getLoggedUser();
        $username = $currentUser->getFirstname().' '.$currentUser->getLastname();
        $workingStore = $currentUser->getWorkingStore();
        $noErrors = true;
        $products = [];

        if ($workingStore->getValid()) {
            $shopName = $workingStore->getName();
            $accessToken = $workingStore->getAccessToken();

            // Get product data
            $productData = $this->getProductsFromStore($shopName, $accessToken);
            $products = $productData['products'];
            $noErrors = $productData['success'];
            $errorCode = $productData['errorCode'];
            $errorMsg = $productData['message'];

            if (!$productData['success'] && $errorCode == ErrorCodes::INVALID_CREDENTIAL) {
                // Store credential is invalid.
                $workingStore->setValid(false);
                $workingStore->setInvalidatedDate(new \DateTimeImmutable());
                $this->daoFactory->getStoreDao()->save($workingStore);
            }
        } else {
            $shopName = 'Invalid store';
            $noErrors = false;
            $errorMsg = ExceptionMessages::INVALID_CREDENTIAL_FRONT;
        }

        $result = [
            'success' => $noErrors,
            'username' => $username,
            'shopname' => $shopName,
            'products' => $products,
            'errorMsg' => $errorMsg,
        ];

        return $result;
    }

    /**
     * Get products of current store.
     *
     * @return mixed[]
     */
    public function getProducts(): array
    {
        $currentUser = $this->userService->getLoggedUser();
        $workingStore = $currentUser->getWorkingStore();
        $noErrors = true;
        $products = [];

        if ($workingStore->getValid()) {
            $shopName = $workingStore->getName();
            $accessToken = $workingStore->getAccessToken();

            // Get product data
            $productData = $this->getProductsFromStore($shopName, $accessToken);
            $products = $productData['products'];
            $noErrors = $productData['success'];
            $errorCode = $productData['errorCode'];
            $errorMsg = $productData['message'];

            if (!$productData['success'] && $errorCode == ErrorCodes::INVALID_CREDENTIAL) {
                // Store credential is invalid.
                $workingStore->setValid(false);
                $workingStore->setInvalidatedDate(new \DateTimeImmutable());
                $this->daoFactory->getStoreDao()->save($workingStore);
            }
        } else {
            $shopName = 'Invalid store';
            $noErrors = false;
            $errorMsg = ExceptionMessages::INVALID_CREDENTIAL_FRONT;
        }

        $result = [
            'success' => $noErrors,
            'products' => $products,
            'errorMsg' => $errorMsg,
        ];

        return $result;
    }

    /**
     * Get products by shop name.
     *
     * @param string $shopName
     * @param string $accessToken
     * @return mixed[]
     */
    public function getProductsFromStore(string $shopName, string $accessToken): array
    {
        $result = [
            'success' => true,
            'products' => [],
            'errorCode' => null,
            'message' => '',
        ];

        try {
            $config = [
                'ShopUrl' => $shopName,
                'AccessToken' => $accessToken
            ];
            $shopify = new ShopifySDK($config);
            $result['products'] = array_map(function ($product) {
                return [
                    'id' => $product['id'],
                    'name' => $product['title'],
                    'updatedAt' => (new \DateTime($product['updated_at']))->format('n/j/Y, g:i:s A'),
                    'image' => $product['image'],
                ];
            }, $shopify->Product->get());
        } catch (ApiException $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
            if ($result['message'] == ExceptionMessages::INVALID_CREDENTIAL) {
                $result['errorCode'] = ErrorCodes::INVALID_CREDENTIAL;
                $result['message'] = ExceptionMessages::INVALID_CREDENTIAL_FRONT;
            } else {
              $result['errorCode'] = ErrorCodes::UNKNOWN;
              $result['message'] = ExceptionMessages::UNKOWN_FRONT;
            }
        }

        return $result;
    }
}
