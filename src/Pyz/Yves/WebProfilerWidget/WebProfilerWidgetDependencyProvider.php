<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\WebProfilerWidget;

use Spryker\Shared\WebProfiler\Plugin\ServiceProvider\WebProfilerServiceProvider;
use Spryker\Yves\Config\Plugin\ServiceProvider\ConfigProfilerServiceProvider;
use SprykerShop\Yves\WebProfilerWidget\WebProfilerWidgetDependencyProvider as SprykerWebProfilerDependencyProvider;

class WebProfilerWidgetDependencyProvider extends SprykerWebProfilerDependencyProvider
{
    /**
     * @return array
     */
    protected function getWebProfilerPlugins(): array
    {
        return [
            new WebProfilerServiceProvider(),
            new ConfigProfilerServiceProvider(),
        ];
    }
}
