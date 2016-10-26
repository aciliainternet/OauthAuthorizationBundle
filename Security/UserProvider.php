<?php
namespace Acilia\Bundle\OauthAuthorizationBundle\Security;

use Acilia\Bundle\OauthAuthorizationBundle\Security\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use GuzzleHttp\Client;
use Exception;

class UserProvider implements UserProviderInterface
{

    protected $access_url;
    protected $enabled;
    protected $oauth_secret;
    protected $client_id;

    public function __construct($access_url, $enabled,  $oauth_secret, $client_id)
    {
        $this->access_url = $access_url;
        $this->enabled = $enabled;
        $this->oauth_secret = $oauth_secret;
        $this->client_id = $client_id;
    }

    public function loadUserByUsername($username)
    {
        if ($this->enabled == false) {
            return new User('anon.', ['ALL'], ['ROLE_USER']);
        }

        $guzzleClient = new Client();

        $authZ = $guzzleClient->get(sprintf('%s/oauth/token?access_token=%s&client_id=%s&client_secret=%s', $this->access_url, $username, $this->client_id, md5($this->client_id . $this->oauth_secret)));

        if ($authZ->getStatusCode() == 200) {
            $authData = json_decode($authZ->getBody(), true);
            if ($authData['auth'] == 1) {
                return new User($authData['data']['user']['name'], $authData['data']['access'], $authData['data']['roles']);
            }

            throw new Exception('User is not authenticated');
        }

        throw new Exception('Cannot connect with oAuth platform');
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $user;
    }

    public function supportsClass($class)
    {
        return $class === 'BackendBundle\Security\FIC_Access\User';
    }
}
