<?php
/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\PrivacyCookieBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ez_privacy_cookie');

        $rootNode
            ->children()
                ->scalarNode('cookie_name')
                    ->defaultValue('privacyCookieAccepted')
                    ->info('name to be used to store cookie status')
                ->end()
                ->integerNode('days')
                    ->defaultValue('365')
                    ->info('how many days banner should be hidden when user accepts policy?')
                ->end()
                ->scalarNode('banner_caption')
                    ->defaultValue('Cookies help us create a good experience. By using our website, you agree to our use of cookies.')
                    ->info('banner description')
                ->end()
                ->scalarNode('banner_link_text')
                    ->defaultValue('Learn more')
                    ->info('banner policy link caption')
                ->end()
                ->scalarNode('banner_link_url')
                    ->info('banner policy address')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
