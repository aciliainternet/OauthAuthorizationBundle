<?php

namespace Acilia\Bundle\OauthAuthorizationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class AciliaOauthAuthorizationExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Locator
        $locator = new FileLocator(__DIR__.'/../Resources/config');

        $loader = new Loader\YamlFileLoader($container, $locator);
        $loader->load('services.yml');

        $container->setParameter('acilia_oauth.enabled', $config['enabled']);
        $container->setParameter('acilia_oauth.oauth_secret', $config['oauth_secret']);
        $container->setParameter('acilia_oauth.client_id', $config['client_id']);
        $container->setParameter('acilia_oauth.access_url', $config['access_url']);
    }
}
