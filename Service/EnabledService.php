<?php

namespace Acilia\Bundle\OauthAuthorizationBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class EnabledService
{
    protected $request;
    protected $enabled;
    protected $excludes;
    protected $oAuthEnabled;

    public function __construct(RequestStack $requestStack, $enabled, $excludes)
    {
        $this->request = $requestStack;
        $this->enabled = $enabled;
        $this->excludes = $excludes;

        $this->oAuthEnabled = true;

        $this->load();
    }

    public function isEnabled()
    {
        return $this->oAuthEnabled;
    }

    protected function load()
    {
        if (! $this->enabled) {
            $this->oAuthEnabled = false;
        }

        if (in_array($this->request->getCurrentRequest()->getHost(), $this->excludes)) {
            $this->oAuthEnabled = false;
        }
    }
}