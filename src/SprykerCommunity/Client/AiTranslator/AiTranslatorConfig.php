<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator;

use Spryker\Client\Kernel\AbstractBundleConfig;
use SprykerCommunity\Shared\AiTranslator\AiTranslatorConstants;

class AiTranslatorConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const DEFAULT_SOURCE_LOCALE = 'en_US';

    /**
     * Specification:
     * - Returns the default source locale for translator.
     *
     * @api
     *
     * @return string
     */
    public function getDefaultSourceLocale(): string
    {
        return static::DEFAULT_SOURCE_LOCALE;
    }

    /**
     * @api
     *
     * @return bool
     */
    public function isCacheEnabled(): bool
    {
        return $this->get(AiTranslatorConstants::ENABLE_CACHE, false);
    }
}
