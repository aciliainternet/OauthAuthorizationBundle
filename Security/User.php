<?php
namespace Acilia\Bundle\OauthAuthorizationBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class User implements UserInterface, EquatableInterface
{
    private $username;
    private $regions;
    private $roles;

    public function __construct($username, array $regions, array $roles)
    {
        $this->username = $username;
        $this->regions = $regions;
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
