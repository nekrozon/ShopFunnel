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
use Zend\Diactoros\Response\RedirectResponse;
use ShopFunnels\Services\HomeService;
use ShopFunnels\Classes\Constants;
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
     * @GET
     *
     * @return HtmlResponse
     */
    public function index(): HtmlResponse
    {
        $this->content->addHtmlElement(new HtmlFromFile('./src/Front/Angular/views/home.html'));

        return new HtmlResponse($this->template);
    }

    /**
     * @URL("/api/verify-store")
     * @GET
     *
     * @param string $storeName
     * @return JsonResponse
     */
    public function verifyStoreAction(string $storeName): JsonResponse
    {
        $success = $this->homeService->verifyStore($storeName);

        return new JsonResponse(['success' => $success]);
    }

    /**
     * @URL("/api/authorize")
     * @GET
     *
     * @param string $storeName
     * @return JsonResponse
     */
    public function authorizeAction(string $storeName): JsonResponse
    {
        $authUri = 'https://'.$storeName.'.myshopify.com/admin/oauth/authorize?client_id='.Constants::API_KEY.'&redirect_uri='.Constants::REDIRECT_URI.'&scope=read_products';

        return new JsonResponse(['authUri' => $authUri]);
    }

    /**
     * @URL("/authorization-handler")
     * @GET
     *
     * @param string $shop
     * @return JsonResponse
     */
    public function authorizationHandlerAction(string $shop): JsonResponse
    {
        $config = [
            'ShopUrl' => $shop,
            'ApiKey' => Constants::API_KEY,
            'SharedSecret' => Constants::SECRET_KEY,
        ];
        ShopifySDK::config($config);
        $token = AuthHelper::getAccessToken();

        $this->homeService->saveStore($shop, $token);

        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/product/list.twig', [
            'shop' => $shop,
        ]));

        return new HtmlResponse($this->template);
    }
}
