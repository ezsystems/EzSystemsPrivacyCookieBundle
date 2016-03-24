<?php
/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\PrivacyCookieBundle\Factory;

use EzSystems\PrivacyCookieBundle\Banner\Banner;
use EzSystems\PrivacyCookieBundle\Banner\BannerFactory;

class ConfigurationBasedBannerFactory implements BannerFactory
{
    public static function build(array $configuration = array())
    {
        $banner = new Banner();

        $banner->cookieName = $configuration['cookie_name'];
        $banner->cookieValidity = $configuration['cookie_validity'];
        $banner->caption = $configuration['banner_caption'];
        $banner->learnMoreText = $configuration['banner_link_text'];
        $banner->policyPageUrl = $configuration['banner_link_url'];

        return $banner;
    }
}
