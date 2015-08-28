<?php
/**
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\PrivacyCookieBundle\Twig;

use EzSystems\PrivacyCookieBundle\Banner\Banner;
use EzSystems\PrivacyCookieBundle\Banner\BannerOptions;
use Twig_Extension;
use Twig_SimpleFunction;
use Twig_Environment;

/**
 * PrivacyCookie Twig helper which renders necessary snippet code.
 */
class PrivacyCookieTwigExtension extends Twig_Extension
{
    /**
     * @var \EzSystems\PrivacyCookieBundle\Banner\Banner
     */
    protected $banner;

    /**
     * @var \EzSystems\PrivacyCookieBundle\Banner\BannerOptions
     */
    protected $bannerOptions;

    public function __construct(BannerOptions $bannerOptions, Banner $banner)
    {
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
            new Twig_SimpleFunction('show_privacy_cookie_banner', array($this, 'showPrivacyCookieBanner'), array(
                'is_safe' => array('html'),
                'needs_environment' => true,
            )),
        );
    }

    /**
     * Render cookie privacy banner snippet code
     * - should be included at the end of template before the body ending tag.
     *
     * @param Twig_Environment $twigEnvironment
     * @param string $policyPageUrl cookie policy page address (not required, no policy link will be shown)
     * @param array $options override default options
     * @return string
     */
    public function showPrivacyCookieBanner(Twig_Environment $twigEnvironment, $policyPageUrl = null, $options = array())
    {
        $options['policyPageUrl'] = $policyPageUrl;

        return $twigEnvironment->render(
            '@EzSystemsPrivacyCookieBundle/Resources/views/privacycookie.html.twig',
            $this->bannerOptions->map($options, $this->banner)
        );
    }
}
