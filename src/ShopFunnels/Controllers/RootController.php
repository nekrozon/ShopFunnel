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
use PHPShopify\ShopifySDK;
use PHPShopify\AuthHelper;

/**
 * RootController Class
 */
class RootController
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
     * RootController's constructor.
     * @param TemplateInterface $template The template used by this controller
     * @param HtmlBlock $content The main content block of the page
     * @param Twig_Environment $twig The Twig environment (used to render Twig templates)
     */
    public function __construct(TemplateInterface $template, HtmlBlock $content, Twig_Environment $twig) {
        $this->template = $template;
        $this->content = $content;
        $this->twig = $twig;
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
