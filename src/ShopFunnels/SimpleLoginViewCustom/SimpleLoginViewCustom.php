<?php

namespace ShopFunnels\SimpleLoginViewCustom;

use Mouf\Html\HtmlElement\HtmlElementInterface;
use Mouf\Html\Renderer\Renderable;
use Mouf\Security\Views\SimpleLoginView;
use Mouf\Utils\Value\ValueInterface;
use Mouf\Utils\Value\ValueUtils;

/**
 * The view for the login screen.
 *
 * @author David
 * @Component
 */
class SimpleLoginViewCustom extends SimpleLoginView
{
    use Renderable;

    /**
     * The label for the "title" field.
     *
     * @var string|ValueInterface
     */
    private $titleLabel;

    /**
     * The label for the "login" field.
     *
     * @var string|ValueInterface
     */
    private $loginLabel;

    /**
     * The label for the "password" field.
     *
     *
     * @var string|ValueInterface
     */
    private $passwordLabel;

    /**
     * The label for the "login" submit button.
     *
     *
     * @var string|ValueInterface
     */
    private $loginSubmitLabel;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $redirecturl;

    /**
     * @var bool
     */
    private $addRememberMeCheckbox;

    /**
     * @var string
     */
    private $loginActionUrl;

    /**
     * The label for the "login" submit button.
     *
     * @var string|ValueInterface
     */
    private $rememberMeLabel;

    /**
     * The label displayed if the user fails to login.
     *
     * @var string|ValueInterface
     */
    private $badCredentialsMessage;

    /**
     * @var bool
     */
    private $displayBadCredentialsMessage = false;

    /**
     * @var string
     */
    private $forgotYourPasswordUrl;

    /**
     * @var string|ValueInterface
     */
    private $forgotYourPasswordLabel;

    /**
     * SimpleLoginViewCustom constructor.
     */
    public function __construct()
    {
        $this->titleLabel = 'Please sign in';
        $this->loginLabel = 'Username';
        $this->passwordLabel = 'Password';
        $this->loginSubmitLabel = 'Login';
        $this->rememberMeLabel = 'Remember me';
        $this->badCredentialsMessage = 'Username or password is incorrect.';
        $this->forgotYourPasswordLabel = 'Forgot password?';
    }

    /**
     * @return ValueInterface|string
     */
    public function getLoginLabel()
    {
        return $this->loginLabel;
    }

    /**
     * @param ValueInterface|string $loginLabel
     */
    public function setLoginLabel($loginLabel)
    {
        $this->loginLabel = $loginLabel;
    }

    /**
     * @return string
     */
    public function getPasswordLabel()
    {
        return ValueUtils::val($this->passwordLabel);
    }

    /**
     * @param ValueInterface|string $passwordLabel
     */
    public function setPasswordLabel($passwordLabel)
    {
        $this->passwordLabel = $passwordLabel;
    }

    /**
     * @return string
     */
    public function getLoginSubmitLabel()
    {
        return ValueUtils::val($this->loginSubmitLabel);
    }

    /**
     * @param ValueInterface|string $loginSubmitLabel
     */
    public function setLoginSubmitLabel($loginSubmitLabel)
    {
        $this->loginSubmitLabel = $loginSubmitLabel;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getRedirecturl()
    {
        return $this->redirecturl;
    }

    /**
     * @param string $redirecturl
     */
    public function setRedirecturl($redirecturl)
    {
        $this->redirecturl = $redirecturl;
    }

    /**
     * @return bool
     */
    public function isAddRememberMeCheckbox()
    {
        return $this->addRememberMeCheckbox;
    }

    /**
     * @param bool $addRememberMeCheckbox
     */
    public function setAddRememberMeCheckbox($addRememberMeCheckbox)
    {
        $this->addRememberMeCheckbox = $addRememberMeCheckbox;
    }

    /**
     * @return string
     */
    public function getRememberMeLabel()
    {
        return ValueUtils::val($this->rememberMeLabel);
    }

    /**
     * @param ValueInterface|string $rememberMeLabel
     */
    public function setRememberMeLabel($rememberMeLabel)
    {
        $this->rememberMeLabel = $rememberMeLabel;
    }

    /**
     * @return string
     */
    public function getLoginActionUrl()
    {
        return $this->loginActionUrl;
    }

    /**
     * The URL of the login action. It is filled automatically by the SimpleLoginController
     *
     * @param string $loginActionUrl
     */
    public function setLoginActionUrl(string $loginActionUrl)
    {
        $this->loginActionUrl = $loginActionUrl;
    }

    /**
     * @return string
     */
    public function getBadCredentialsMessage()
    {
        return ValueUtils::val($this->badCredentialsMessage);
    }

    /**
     * @param ValueInterface|string $badCredentialsMessage
     */
    public function setBadCredentialsMessage($badCredentialsMessage)
    {
        $this->badCredentialsMessage = $badCredentialsMessage;
    }

    /**
     * @return boolean
     */
    public function isDisplayBadCredentialsMessage()
    {
        return $this->displayBadCredentialsMessage;
    }

    public function enableBadCredentialsMessage()
    {
        $this->displayBadCredentialsMessage = true;
    }

    /**
     * @return string
     */
    public function getForgotYourPasswordUrl()
    {
        return $this->forgotYourPasswordUrl;
    }

    /**
     * @param string $forgotYourPasswordUrl
     */
    public function setForgotYourPasswordUrl($forgotYourPasswordUrl)
    {
        $this->forgotYourPasswordUrl = $forgotYourPasswordUrl;
    }

    /**
     * @return ValueInterface|string
     */
    public function getForgotYourPasswordLabel()
    {
        return ValueUtils::val($this->forgotYourPasswordLabel);
    }

    /**
     * @param ValueInterface|string $forgotYourPasswordLabel
     */
    public function setForgotYourPasswordLabel($forgotYourPasswordLabel)
    {
        $this->forgotYourPasswordLabel = $forgotYourPasswordLabel;
    }

    /**
     * @return string
     */
    public function getTitleLabel()
    {
        return ValueUtils::val($this->titleLabel);
    }

    /**
     * @param ValueInterface|string $titleLabel
     */
    public function setTitleLabel($titleLabel)
    {
        $this->titleLabel = $titleLabel;
    }
}
