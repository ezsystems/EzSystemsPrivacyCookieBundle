<?php
/**
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\PrivacyCookieBundle\Banner;

class BannerOptions
{
    /**
     * Map banner options.
     *
     * @param array $options
     * @param \EzSystems\PrivacyCookieBundle\Banner\Banner $banner
     * @return array
     */
    public function map(array $options, Banner $banner)
    {
        $bannerOptions = get_object_vars($banner);

        $validatedOptions = array();
        foreach ($bannerOptions as $name => $value) {
            $validatedOptions[$name] = empty($options[$name]) ? $value : $options[$name];
        }

        return $validatedOptions;
    }
}
