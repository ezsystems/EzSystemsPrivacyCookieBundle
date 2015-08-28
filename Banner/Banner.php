<?php
/**
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\PrivacyCookieBundle\Banner;

class Banner
{
    /**
     * Banner caption.
     *
     * @var string
     */
    public $caption;

    /**
     * Text linked to the policy page.
     *
     * @var string
     */
    public $learnMoreText;

    /**
     * URL to the detailled cookies & privacy legacy page.
     *
     * @var string
     */
    public $policyPageUrl;

    /**
     * Name of the cookie used to store the user's choice.
     *
     * @var string
     */
    public $cookieName;

    /**
     * Cookie validity duration, in days.
     *
     * @var int
     */
    public $cookieValidity;
}
