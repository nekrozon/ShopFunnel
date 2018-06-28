<?php
namespace ShopFunnels\Controllers;

use Mouf\Mvc\Splash\Annotations\Get;
use Mouf\Mvc\Splash\Annotations\Post;
use Mouf\Mvc\Splash\Annotations\Put;
use Mouf\Mvc\Splash\Annotations\Delete;
use Mouf\Mvc\Splash\Annotations\URL;
use Mouf\Security\Logged;
use Mouf\Html\Template\TemplateInterface;
use Mouf\Html\HtmlElement\HtmlBlock;
use Mouf\Html\HtmlElement\HtmlFromFile;
use \Twig_Environment;
use Mouf\Html\Renderer\Twig\TwigTemplate;
use Mouf\Mvc\Splash\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use ShopFunnels\Services\DashboardService;

/**
 * DashboardController Class
 */
class DashboardController
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
     * @var DashboardService
     */
    private $dashboardService;

    /**
     * DashboardController's constructor.
     * @param TemplateInterface   $template
     * @param HtmlBlock           $content
     * @param Twig_Environment    $twig
     * @param DashboardService    $dashboardService
     */
    public function __construct(TemplateInterface $template, HtmlBlock $content, Twig_Environment $twig, DashboardService $dashboardService)
    {
        $this->template = $template;
        $this->content = $content;
        $this->twig = $twig;
        $this->dashboardService = $dashboardService;
    }

    /**
     * @URL("/dashboard")
     * @Logged
     * @GET
     *
     * @return HtmlResponse
     */
    public function index(): HtmlResponse
    {
        $this->content->addHtmlElement(new HtmlFromFile('./src/Front/Angular/views/dashboard.html'));

        return new HtmlResponse($this->template);
    }

    /**
     * @URL("/api/get-dashboard-data")
     * @Logged
     * @GET
     *
     * @return JsonResponse
     */
    public function getInitDataAction(): JsonResponse
    {
        $result = $this->dashboardService->getInitData();

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/get-forms")
     * @Logged
     * @GET
     *
     * @return JsonResponse
     */
    public function getFormsAction(): JsonResponse
    {
        $forms = $this->dashboardService->getSerializedFunnelForms();
        $result = ['success' => true, 'funnelForms' => $forms];

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/get-products")
     * @Logged
     * @GET
     *
     * @return JsonResponse
     */
    public function getProductsAction(): JsonResponse
    {
        $result = $this->dashboardService->getProducts();

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/get-orders")
     * @Logged
     * @GET
     *
     * @return JsonResponse
     */
    public function getOrdersAction(): JsonResponse
    {
        $result = $this->dashboardService->getOrders();

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/create-form")
     * @Logged
     * @POST
     *
     * @param mixed[] $formData
     * @return JsonResponse
     */
    public function createFormAction(array $formData): JsonResponse
    {
        $result = $this->dashboardService->createForm($formData);

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/delete-form/{formId}")
     * @Logged
     * @DELETE
     *
     * @param int $formId
     * @return JsonResponse
     */
    public function deleteFormAction(int $formId): JsonResponse
    {
        $result = $this->dashboardService->deleteForm($formId);

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/update-form")
     * @Logged
     * @POST
     *
     * @param mixed[] $formData
     * @return JsonResponse
     */
    public function updateFormAction(array $formData): JsonResponse
    {
        $result = $this->dashboardService->updateForm($formData);

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/delete-product/{productId}")
     * @Logged
     * @DELETE
     *
     * @param int $productId
     * @return JsonResponse
     */
    public function deleteProductAction(int $productId): JsonResponse
    {
        $result = $this->dashboardService->deleteProduct($productId);

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/update-product")
     * @Logged
     * @POST
     *
     * @param mixed[] $productData
     * @return JsonResponse
     */
    public function updateProductAction(array $productData): JsonResponse
    {
        $result = $this->dashboardService->updateProduct($productData);

        return new JsonResponse($result);
    }

    /**
     * @URL("/api/get-form-products/{formId}")
     * @Logged
     * @GET
     *
     * @param int $formId
     * @return JsonResponse
     */
    public function getFormProductsAction(int $formId): JsonResponse
    {
        $result = $this->dashboardService->getFormProducts($formId);

        return new JsonResponse($result);
    }
}
