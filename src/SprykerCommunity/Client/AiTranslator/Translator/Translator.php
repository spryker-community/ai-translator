<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator\Translator;

use Generated\Shared\Transfer\AiTranslatorRequestTransfer;
use Generated\Shared\Transfer\AiTranslatorResponseTransfer;
use SprykerCommunity\Client\AiTranslator\AiTranslatorConfig;
use SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface;

class Translator implements TranslatorInterface
{
    /**
     * @var \SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface
     */
    protected TranslatorEnginePluginInterface $translatorEnginePlugin;

    /**
     * @var \SprykerCommunity\Client\AiTranslator\AiTranslatorConfig
     */
    protected AiTranslatorConfig $config;

    /**
     * @param \SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface $translatorEnginePlugin
     * @param \SprykerCommunity\Client\AiTranslator\AiTranslatorConfig $config
     */
    public function __construct(TranslatorEnginePluginInterface $translatorEnginePlugin, AiTranslatorConfig $config)
    {
        $this->translatorEnginePlugin = $translatorEnginePlugin;
        $this->config = $config;
    }

    /**
     * // TODO: add validation - source and target locales must not match.
     *
     * @param \Generated\Shared\Transfer\AiTranslatorRequestTransfer $aiTranslatorRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AiTranslatorResponseTransfer
     */
    public function translate(AiTranslatorRequestTransfer $aiTranslatorRequestTransfer): AiTranslatorResponseTransfer
    {
        $aiTranslatorRequestTransfer = $this->normalizeSourceLocale($aiTranslatorRequestTransfer);

        return $this->translatorEnginePlugin->translate($aiTranslatorRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AiTranslatorRequestTransfer $aiTranslatorRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AiTranslatorRequestTransfer
     */
    protected function normalizeSourceLocale(AiTranslatorRequestTransfer $aiTranslatorRequestTransfer): AiTranslatorRequestTransfer
    {
        $sourceLocale = $aiTranslatorRequestTransfer->getSourceLocale() ?? $this->config->getDefaultSourceLocale();
        $aiTranslatorRequestTransfer->setSourceLocale($sourceLocale);

        return $aiTranslatorRequestTransfer;
    }
}
