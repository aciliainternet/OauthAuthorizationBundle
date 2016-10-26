<?php
namespace Acilia\Bundle\OauthAuthorizationBundle\Security;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    protected $access_url;

    public function __construct($access_url)
    {
        $this->access_url = $access_url;
    }

    public function onLogoutSuccess(Request $request)
    {
        return new RedirectResponse($this->access_url);
    }
}