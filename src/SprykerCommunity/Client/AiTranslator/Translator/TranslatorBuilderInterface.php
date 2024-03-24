<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator\Translator;

interface TranslatorBuilderInterface
{
    /**
     * @return \SprykerCommunity\Client\AiTranslator\Translator\TranslatorInterface
     */
    public function buildTranslator(): TranslatorInterface;
}
