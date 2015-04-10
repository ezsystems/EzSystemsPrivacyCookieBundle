<?php
/**
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\PrivacyCookieBundle\Twig;

use EzSystems\PrivacyCookieBundle\Banner\Banner;
use EzSystems\PrivacyCookieBundle\Banner\BannerOptions;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Extension;
use Twig_Function_Method;

/**
 * PrivacyCookie Twig helper which renders necessary snippet code.
 */
class PrivacyCookieTwigExtension extends Twig_Extension
{
    /**
     * we must inject service_container this way
     * @link https://github.com/symfony/symfony/issues/2347
     *
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var \EzSystems\PrivacyCookieBundle\Banner\Banner
     */
    protected $banner;

    /**
     * @var \EzSystems\PrivacyCookieBundle\Banner\BannerOptions
     */
    protected $bannerOptions;

    public function __construct(ContainerInterface $container, BannerOptions $bannerOptions, Banner $banner)
    {
        $this->container = $container;
        $this->bannerOptions = $bannerOptions;
        $this->banner = $banner;
    }

    public function getName()
    {
        return 'ez_privacy_cookie_extension';
    }

    public function getFunctions()
    {
        return array(
            'show_privacy_cookie_banner' => new Twig_Function_Method($this, 'showPrivacyCookieBanner', array(
                'is_safe' => array('html')
            )),
        );
    }

    /**
     * Render cookie privacy banner snippet code
     * - should be included at the end of template before the body ending tag
     *
     * @param string $policyPageUrl cookie policy page address (not required, no policy link will be shown)
     * @param array $options override default options
     * @return string
     */
    public function showPrivacyCookieBanner($policyPageUrl = null, $options = array())
    {
        $options['policyPageUrl'] = $policyPageUrl;

        return $this->container->get("templating")->render(
            '@EzSystemsPrivacyCookieBundle/Resources/views/privacycookie.html.twig',
            $this->bannerOptions->map($options, $this->banner)
        );
    }
}
