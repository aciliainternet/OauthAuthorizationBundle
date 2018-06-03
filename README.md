# OauthAuthorizationBundle
Acilia oAuth authentication and authroization Bundle for Symfony4.

Symfony2 and Symfony3 versios available here: https://github.com/aciliainternet/OauthAuthorizationBundle

# OauthAuthorizationBundle

Symfony4 Oauth Authorization bundle developed by Acilia Internet.

This bundle allows to authenticate and get authrozation against Oauth2 API service and creates a UserProviderInterface.

## Installation and configuration:

Pretty simple with [Composer](http://packagist.org), run:

```sh
composer require aciliainternet/oauth-authorization-bundle
```

### Add OauthAuthorizationBundle to your application bundles

```php
// config/bundles.php
return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    //...

    Acilia\Bundle\OauthAuthorizationBundle\AciliaOauthAuthorizationBundle::class => ['all' => true]
];
```

### Configuration example

This bundle provides a basic security.yaml, you can import from your security.yaml file
```
imports:
    - { resource: "@AciliaOauthAuthorizationBundle/Resources/config/security.yaml" }
```
You must configure some parameters

```yaml
acilia_oauth_authorization:
    access_url: 'http://api.my-oauth2.com' # url of the oauth api
    enabled: true                          # enable or disable authentication, if false users as authenticated as 'anon.'
    oauth_secret: '_secret_hash_'          # hash for encrypt requests to the api
    client_id: 'my_app_identifier_key'     # unique identifier for the application
    # non mandatory
    excludes: ['www.domain-excluded.com']  # array of domains to exclude from the auth checking
    api_tokens: ['secret-token']           # array of tokens available to use for test
```

Finally, you'll need to define the logout path. Add to your routing.yaml file the following:
```
logout:
    path: /logout
```

Or import the available routes.yaml provided by the framework to your routes.yaml file.
```
oauth_authorization_bundle:
    resource: '@AciliaOauthAuthorizationBundle/Resources/config/routes.yaml'
```
