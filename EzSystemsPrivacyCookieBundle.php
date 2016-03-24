<?php
/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\PrivacyCookieBundle;

use EzSystems\PrivacyCookieBundle\DependencyInjection\EzSystemsPrivacyCookieExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EzSystemsPrivacyCookieBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new EzSystemsPrivacyCookieExtension();
    }
}
