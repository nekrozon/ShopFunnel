<?php

namespace ShopFunnels\Services;

use ShopFunnels\Classes\ExceptionMessages;
use ShopFunnels\Classes\ErrorCodes;
use ShopFunnels\Dao\Generated\DaoFactory;
use ShopFunnels\Enumerations\FunnelFormTypeEnum;
use ShopFunnels\Enumerations\ProductTypeEnum;
use ShopFunnels\Enumerations\VariantTypeEnum;
use ShopFunnels\Enumerations\VariantStyleEnum;
use ShopFunnels\Model\FunnelForm;
use Mouf\Security\UserService\UserService;
use PHPShopify\Exception\ApiException;
use PHPShopify\ShopifySDK;
use Ramsey\Uuid\Uuid;
use TheCodingMachine\TDBM\TDBMException;

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
        $funnelForms = $this->getSerializedFunnelForms();
        $orders = [];
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

            if ($noErrors) {
                // Get order data
                $orderData = $this->getOrdersFromStore($shopName, $accessToken);
                $orders = $orderData['orders'];
                $noErrors = $orderData['success'];
                $errorCode = $orderData['errorCode'];
                $errorMsg = $orderData['message'];

                if (!$productData['success'] && $errorCode == ErrorCodes::INVALID_CREDENTIAL) {
                    // Store credential is invalid.
                    $workingStore->setValid(false);
                    $workingStore->setInvalidatedDate(new \DateTimeImmutable());
                    $this->daoFactory->getStoreDao()->save($workingStore);
                }
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
            'funnelForms' => $funnelForms,
            'products' => $products,
            'orders' => $orders,
            'errorMsg' => $errorMsg,
            'static' => $this->getStaticData()
        ];

        return $result;
    }

    /**
     * Get serialized funnel forms.
     *
     * @return mixed[]
     */
    public function getSerializedFunnelForms(): array
    {
        $result = [];
        $funnelForms = $this->daoFactory->getFunnelFormDao()->findAll()->toArray();
        foreach ($funnelForms as $form) {
            $item = $form->jsonSerialize();
            $item['scriptUri'] = '<script src="http://dev.shopfunnelapp.com/scripts/'.$item['scriptUri'].'"></script>';
            $item['updatedAt'] = $form->getUpdatedAt()->format('n/j/Y, g:i:s A');
            $item['products'] = [];
            $products = $form->getProducts();
            foreach ($products as $product) {
                $productData = $product->jsonSerialize();
                unset($productData['funnelForms']);
                $item['products'][] = $productData;
            }
            $result[] = $item;
        }

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
     * Get orders of current store.
     *
     * @return mixed[]
     */
    public function getOrders(): array
    {
        $currentUser = $this->userService->getLoggedUser();
        $workingStore = $currentUser->getWorkingStore();
        $noErrors = true;
        $orders = [];

        if ($workingStore->getValid()) {
            $shopName = $workingStore->getName();
            $accessToken = $workingStore->getAccessToken();

            // Get product data
            $orderData = $this->getOrdersFromStore($shopName, $accessToken);
            $orders = $orderData['orders'];
            $noErrors = $orderData['success'];
            $errorCode = $orderData['errorCode'];
            $errorMsg = $orderData['message'];

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
            'orders' => $orders,
            'errorMsg' => $errorMsg,
        ];

        return $result;
    }

    /**
     * Get products from shopify store.
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

    /**
     * Get orders from shopify store.
     *
     * @param string $shopName
     * @param string $accessToken
     * @return mixed[]
     */
    public function getOrdersFromStore(string $shopName, string $accessToken): array
    {
        $result = [
            'success' => true,
            'orders' => [],
            'errorCode' => null,
            'message' => '',
        ];

        try {
            $config = [
                'ShopUrl' => $shopName,
                'AccessToken' => $accessToken
            ];
            $shopify = new ShopifySDK($config);
            $result['orders'] = array_map(function ($order) {
                $orderData = [
                    'id' => $order['id'],
                    'name' => $order['name'],
                    'customerName' => $order['customer']['first_name'].' '.$order['customer']['last_name'],
                    'customerEmail' => $order['email'],
                    'financialStatus' => str_replace('_', ' ', $order['financial_status']),
                    'totalPrice' => $order['total_price'],
                    'productCount' => count($order['line_items']),
                    'submitted' => true,
                    'updatedAt' => (new \DateTime($order['updated_at']))->format('n/j/Y, g:i:s A'),
                    'products' => [],
                ];
                foreach ($order['line_items'] as $lineItem) {
                    $productData = [
                        'id' => $lineItem['product_id'],
                        'price' => $lineItem['price'],
                        'quantity' => $lineItem['quantity'],
                        'variantTitle' => $lineItem['variant_title'],
                        'financialStatus' => 'paid',
                    ];
                    $orderData['products'][] = $productData;
                }

                return $orderData;
            }, $shopify->Order->get());
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

    /**
     * Get all static data.
     *
     * @return mixed[]
     */
    public function getStaticData(): array
    {
        $result = [
            'constants' => [
                'funnelFormTypeEnum' => FunnelFormTypeEnum::toArray(),
                'productTypeEnum' => ProductTypeEnum::toArray(),
                'variantTypeEnum' => VariantTypeEnum::toArray(),
                'variantStyleEnum' => VariantStyleEnum::toArray(),
            ],
            'funnelFormTypes' => $this->daoFactory->getFunnelFormTypeDao()->findAll()->toArray(),
            'productTypes' => $this->daoFactory->getProductTypeDao()->findAll()->toArray(),
            'variantTypes' => $this->daoFactory->getVariantTypeDao()->findAll()->toArray(),
            'variantStyles' => $this->daoFactory->getVariantStyleDao()->findAll()->toArray(),
        ];

        return $result;
    }

    /**
     * Create new funnel form.
     *
     * @param mixed[] $formData
     * @return mixed[]
     */
    public function createForm(array $formData): array
    {
        $formType = $this->daoFactory->getFunnelFormTypeDao()->getById($formData['type']['id']);
        $formName = $formData['name'];
        $form = new FunnelForm($formType, $formName);
        $scriptName = (string) Uuid::uuid1();
        $form->setScriptUri($scriptName);
        $this->daoFactory->getFunnelFormDao()->save($form);

        return ['success' => 'true'];
    }

    /**
     * Delete funnel form.
     *
     * @param int $formId
     * @return mixed[]
     */
    public function deleteForm(int $formId): array
    {
        $formDao = $this->daoFactory->getFunnelFormDao();
        $form = $formDao->getById($formId);
        $formDao->delete($form);

        return ['success' => 'true'];
    }

    /**
     * Update funnel form.
     *
     * @param mixed[] $formData
     * @return mixed[]
     */
    public function updateForm(array $formData): array
    {
        $formDao = $this->daoFactory->getFunnelFormDao();
        $form = $formDao->getById($formData['id']);
        $form->setName($formData['name']);
        $form->setPurchaseButtonLabel(empty($formData['purchaseButtonLabel']) ? null : $formData['purchaseButtonLabel']);
        $form->setShowVariantsButtonLabel(empty($formData['showVariantsButtonLabel']) ? null : $formData['showVariantsButtonLabel']);
        $form->setHideVariantsButtonLabel(empty($formData['hideVariantsButtonLabel']) ? null : $formData['hideVariantsButtonLabel']);
        $form->setShowOrderTotal($formData['showOrderTotal']);
        $form->setReloadOnProductChange($formData['reloadOnProductChange']);
        $form->setUpdatedAt(new \DateTimeImmutable());
        $formDao->save($form);

        return ['success' => 'true'];
    }

    /**
     * Delete product.
     *
     * @param int $productId
     * @return mixed[]
     */
    public function deleteProduct(int $productId): array
    {
        $productDao = $this->daoFactory->getProductDao();
        $product = $productDao->getById($productId);
        $productDao->delete($product);

        return ['success' => 'true'];
    }

    /**
     * Update product.
     *
     * @param mixed[] $productData
     * @return mixed[]
     */
    public function updateProduct(array $productData): array
    {
        $productDao = $this->daoFactory->getProductDao();
        $variantTypeDao = $this->daoFactory->getVariantTypeDao();
        $variantStyleDao = $this->daoFactory->getVariantStyleDao();

        $product = $productDao->getById($productData['id']);
        $product->setClickFunnelName($productData['clickFunnelName']);
        $product->setCustomNameLine1(empty($productData['customNameLine1']) ? null : $productData['customNameLine1']);
        $product->setCustomNameLine2(empty($productData['customNameLine2']) ? null : $productData['customNameLine2']);
        $product->setMinQuantity($productData['minQuantity']);
        $product->setMaxQuantity($productData['maxQuantity']);
        $product->setExpandVariants($productData['expandVariants']);
        $product->setMaxQuantity($productData['maxQuantity']);
        $product->setMaxQuantity($productData['maxQuantity']);
        $product->setVariantType($variantTypeDao->getById($productData['variantType']['id']));
        $product->setVariantModelStyle($variantStyleDao->getById($productData['variantModelStyle']['id']));
        $product->setVariantColorStyle($variantStyleDao->getById($productData['variantColorStyle']['id']));
        $product->setVariantSizeStyle($variantStyleDao->getById($productData['variantSizeStyle']['id']));
        $product->setFormattedPrice(empty($productData['formattedPrice']) ? null : $productData['formattedPrice']);
        $product->setUpdatedAt(new \DateTimeImmutable());

        $productDao->save($product);

        return ['success' => 'true'];
    }

    /**
     * Get form products.
     *
     * @param int $formId
     * @return mixed[]
     */
    public function getFormProducts(int $formId): array
    {
        $result = ['success' => true, 'products' => []];

        $form = $this->daoFactory->getFunnelFormDao()->getById($formId);
        $products = $form->getProducts();
        foreach ($products as $product) {
            $productData = $product->jsonSerialize();
            unset($productData['funnelForms']);
            $result['products'][] = $productData;
        }

        return $result;
    }
}
