<?php

namespace ShopFunnels\Controllers;

use ShopFunnels\Services\UserModelService;
use Mouf\Html\HtmlElement\HtmlFromFile;
use Mouf\Mvc\Splash\Annotations\Get;
use Mouf\Mvc\Splash\Annotations\Post;
use Mouf\Mvc\Splash\Annotations\URL;
use Mouf\Html\HtmlElement\HtmlBlock;
use Mouf\Html\Renderer\Twig\TwigTemplate;
use Mouf\Html\Template\TemplateInterface;
use Mouf\Mvc\Splash\HtmlResponse;
use Mouf\Security\Password\Api\PasswordStrengthCheck;
use Mouf\Security\UserService\UserService;
use Nette\Utils\Json;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use \Twig_Environment;
use Mouf\Security\Logged;
use Zend\Diactoros\Response\JsonResponse;

class UserController
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
     * The UserModelService (used to interact with user's DB)
     * @var UserModelService
     */
    private $userModelService;

    /**
     * The UserService (used for checking current user)
     * @var UserService
     */
    private $userService;

    /**
     * Controller's constructor.
     * @param TemplateInterface $template The template used by this controller
     * @param HtmlBlock $content The main content block of the page
     * @param Twig_Environment $twig The Twig environment (used to render Twig templates)
     * @param UserModelService $userModelService The UserModelService (used to interact with user's DB)
     * @param UserService $userService The UserService (used for checking the current user)
     */
    public function __construct(
        TemplateInterface $template,
        HtmlBlock $content,
        Twig_Environment $twig,
        UserModelService $userModelService,
        UserService $userService
    ) {
        $this->template = $template;
        $this->content = $content;
        $this->twig = $twig;
        $this->userModelService = $userModelService;
        $this->userService = $userService;
    }
}
