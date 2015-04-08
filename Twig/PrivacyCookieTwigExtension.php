<?php
/**
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\PrivacyCookieBundle\Twig;

use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Twig_Extension;
use \Twig_Function_Method;

/**
 * PrivacyCookie Twig helper which renders necessary snippet code.
 */
class PrivacyCookieTwigExtension extends Twig_Extension
{
    /**
     * we must inject service_container this way
     * @link https://github.com/symfony/symfony/issues/2347
     *
     * @var $container \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * default cookie name
     *
     * @var $defaultCookieName string
     */
    protected $defaultCookieName;

    /**
     * default cookie validity days
     *
     * @var $defaultValidityDays int
     */
    protected $defaultValidityDays;

    public function __construct(ContainerInterface $container, $defaultCookieName, $defaultValidityDays)
    {
        $this->container = $container;
        $this->defaultCookieName = $defaultCookieName;
        $this->defaultValidityDays = $defaultValidityDays;
    }

    public function getName()
    {
        return 'ez_privacy_cookie_extension';
    }

    public function getFunctions()
    {
        return array(
            'show_privacy_cookie_banner' => new Twig_Function_Method($this, 'showPrivacyCookieBanner', array(
                'is_safe' => array( 'html' )
            )),
        );
    }

    /**
     * Render cookie privacy banner snippet code
     * - should be included at the end of template before the body ending tag
     *
     * @param string $policyUrl cookie policy page address (not required, no policy link will be shown)
     * @param array $options optional parameters:
     *        cookieName - name to be used to store cookie status
     *        days - for how many days this banner should be hidden when user accepts policy?
     *        bannerCaption - replace default banner message caption
     * @return string
     */
    public function showPrivacyCookieBanner($policyUrl = null, array $options = array())
    {
        return $this->container->get("templating")->render(
            '@EzSystemsPrivacyCookieBundle/Resources/views/privacycookie.html.twig',
            array(
                'policyUrl' => $policyUrl,
                'cookieName' => empty($options[ 'cookieName' ]) ? $this->defaultCookieName : $options[ 'cookieName' ],
                'days' => empty($options[ 'days' ]) ? $this->defaultValidityDays : $options[ 'days' ],
                'bannerCaption' => empty($options[ 'bannerCaption' ]) ? null : $options[ 'bannerCaption' ]
            )
        );
    }
}
