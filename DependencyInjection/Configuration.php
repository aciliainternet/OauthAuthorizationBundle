<?php

namespace Acilia\Bundle\OauthAuthorizationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('acilia_oauth_authorization');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->booleanNode('enabled')->defaultTrue()->end()
                ->scalarNode('oauth_secret')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('client_id')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('access_url')->isRequired()->cannotBeEmpty()->end()
                ->arrayNode('excludes')->canBeUnset()->prototype('scalar')->end()->end()
                ->arrayNode('api_tokens')->canBeUnset()->prototype('scalar')->end()->end()
            ->end();

        return $treeBuilder;
    }
}
