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

    public function __construct($username, array $access, array $roles, array $metadata)
    {
        $this->username = $username;
        $this->access = $access;
        $this->regions = $this->access;
        $this->roles = $roles;
        $this->metadata = $metadata;
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

    public function getAccess()
    {
        return $this->access;
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
