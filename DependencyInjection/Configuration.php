<?php
/**
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\PrivacyCookieBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\Configuration as SiteAccessConfiguration;

class Configuration extends SiteAccessConfiguration
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ez_privacy_cookie');
        $systemNode = $this->generateScopeBaseNode($rootNode);

        $systemNode
            ->scalarNode('cookie_name')
                ->defaultValue('privacyCookieAccepted')
                ->info('name to be used to store cookie status')
                ->isRequired()
            ->end()
            ->integerNode('days')
                ->defaultValue('365')
                ->info('how many days banner should be hidden when user accepts policy?')
                ->isRequired()
            ->end();

        return $treeBuilder;
    }
}
