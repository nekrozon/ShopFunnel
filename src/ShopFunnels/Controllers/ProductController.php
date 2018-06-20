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
use ShopFunnels\Services\ProductService;
use ShopFunnels\Classes\Constants;
use PHPShopify\ShopifySDK;
use PHPShopify\AuthHelper;

/**
 * ProductController Class
 */
class ProductController
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
     * @var ProductService
     */
    private $productService;

    /**
     * ProductController's constructor.
     * @param TemplateInterface   $template
     * @param HtmlBlock           $content
     * @param Twig_Environment    $twig
     * @param HomeService         $homeService
     */
    public function __construct(TemplateInterface $template, HtmlBlock $content, Twig_Environment $twig, ProductService $productService)
    {
        $this->template = $template;
        $this->content = $content;
        $this->twig = $twig;
        $this->productService = $productService;
    }

    /**
     * @URL("/products")
     * @GET
     *
     * @param string $shop
     * @return HtmlResponse
     */
    public function index(string $shop): HtmlResponse
    {
        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/product/list.twig', [
            'shop' => $shop,
        ]));

        return new HtmlResponse($this->template);
    }
}
