<?php

namespace Acilia\Bundle\OauthAuthorizationBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class User implements UserInterface, EquatableInterface
{
    private $username;
    private $regions;
    private $roles;
    private $metadata;
    private $access;

    public function __construct($username, array $access, array $roles)
    {
        $this->username = $username;
        $this->access = $access;

        if(array_keys($this->access) !== range(0, count($this->access) - 1)) {
            $this->regions = [];
            $this->metadata = [];
            foreach ($this->access as $key => $item) {
                $this->regions[$key] = $item['code'];
                $this->metadata[$item['code']] = $item['metadata']; // TODO CHECK IT
            }
        }else{
            $this->regions = $this->access;
            $this->metadata = null;
        }

        $this->roles = $roles;
    }

    public function getRegions()
    {
        return $this->regions;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return '';
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof self) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}
