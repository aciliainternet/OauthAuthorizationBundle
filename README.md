# OauthAuthorizationBundle
Acilia oAuth authentication and authroization Bundle for Symfony2/3

# OauthAuthorizationBundle

Symfony2 and Symfony3 Oauth Authorization bundle developed by Acilia Internet

This bundle allows to authenticate and get authrozation against Oauth2 API service and creates a UserProviderInterface

## Installation and configuration:

Pretty simple with [Composer](http://packagist.org), run:

```sh
composer require aciliainternet/oauth-authorization-bundle
```

### Add OauthAuthorizationBundle to your application kernel

```php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new Acilia\Bundle\OauthAuthorizationBundle\AciliaOauthAuthorizationBundle(),
        // ...
    );
}
```
<a name="configuration"></a>

### Configuration example

This bundle provides a basic security.yml, you can import from your security.yml file
```
imports:
    - { resource: "@AciliaOauthAuthorizationBundle/Resources/config/security.yml" }
```
You must configure some parameters

```yaml
acilia_oauth_authorization:
    access_url: 'http://api.my-oauth2.com' # url of the oauth api
    enabled: true                          # enable or disable authentication, if false users as authenticated as 'anon.'
    oauth_secret: '_secret_hash_'          # hash for encrypt requests to the api
    client_id: 'my_app_identifier_key'     # unique identifier for the application
```
