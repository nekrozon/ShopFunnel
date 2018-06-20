<?php
namespace ShopFunnels\Controllers;

use Mouf\Mvc\Splash\Annotations\Get;
use Mouf\Mvc\Splash\Annotations\Post;
use Mouf\Mvc\Splash\Annotations\Put;
use Mouf\Mvc\Splash\Annotations\Delete;
use Mouf\Mvc\Splash\Annotations\URL;
use Mouf\Html\Template\TemplateInterface;
use Mouf\Html\HtmlElement\HtmlBlock;
use Mouf\Html\HtmlElement\HtmlFromFile;
use \Twig_Environment;
use Mouf\Html\Renderer\Twig\TwigTemplate;
use Mouf\Mvc\Splash\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use ShopFunnels\Services\HomeService;
use PHPShopify\ShopifySDK;
use PHPShopify\AuthHelper;

/**
 * HomeController Class
 */
class HomeController
{
    /**
     * The template used by this controller.
     * @var TemplateInterface
     */
    private $template;

    /**
     * The main content block of the page.
     * @var HtmlBlock
     */
    private $content;

    /**
     * The Twig environment (used to render Twig templates).
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var HomeService
     */
    private $homeService;

    /**
     * HomeController's constructor.
     * @param TemplateInterface   $template
     * @param HtmlBlock           $content
     * @param Twig_Environment    $twig
     * @param HomeService         $homeService
     */
    public function __construct(TemplateInterface $template, HtmlBlock $content, Twig_Environment $twig, HomeService $homeService)
    {
        $this->template = $template;
        $this->content = $content;
        $this->twig = $twig;
        $this->homeService = $homeService;
    }

    /**
     * @URL("/")
     */
    public function index()
    {
        $this->content->addHtmlElement(new HtmlFromFile('./src/Front/Angular/views/home.html'));

        return new HtmlResponse($this->template);
    }

    /**
     * @URL("/test")
     */
    public function testAction()
    {
        return new JsonResponse(['status' => 'running']);
    }

    /**
     * @URL("/api/verify-store")
     * @GET
     *
     * @param string $storeName
     * @return JsonResponse
     */
    public function verifyStoreAction(string $storeName)
    {
        $success = $this->homeService->verifyStore($storeName);

        return new JsonResponse(['success' => $success]);
    }

    /**
     * Fetch shopify products by API key
     *
     * @URL("/get-products")
     * @GET
     * @return JsonResponse
     */
    public function getProductsAction(): JsonResponse
    {
        $config = [
            'ShopUrl' => 'midnightpoint.myshopify.com',
            'ApiKey' => '63ad8bb37986eddbc73da803fa591e7c',
            'SharedSecret' => '9e7c060a1849ad2dbadf2fb71dae7b9e',
        ];
        ShopifySDK::config($config);
        $token = AuthHelper::createAuthRequest('read_products');

        return new JsonResponse(['token' => $token]);
    }
}
