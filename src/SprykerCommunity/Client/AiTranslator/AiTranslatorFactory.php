<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Storage\StorageClientInterface;
use SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface;
use SprykerCommunity\Client\AiTranslator\Translator\TranslatorBuilder;
use SprykerCommunity\Client\AiTranslator\Translator\TranslatorInterface;

/**
 * @method \SprykerCommunity\Client\AiTranslator\AiTranslatorConfig getConfig()
 */
class AiTranslatorFactory extends AbstractFactory
{
    /**
     * @return \SprykerCommunity\Client\AiTranslator\Translator\TranslatorInterface
     */
    public function createTranslator(): TranslatorInterface
    {
        $translatorBuilder = new TranslatorBuilder(
            $this->getConfig(),
            $this->getStorageClient(),
            $this->getTranslatorEnginePlugin(),
        );

        return $translatorBuilder->buildTranslator();
    }

    /**
     * @return \SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface
     */
    public function getTranslatorEnginePlugin(): TranslatorEnginePluginInterface
    {
        return $this->getProvidedDependency(AiTranslatorDependencyProvider::PLUGIN_TRANSLATOR_ENGINE);
    }

    /**
     * @return \Spryker\Client\Storage\StorageClientInterface
     */
    public function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(AiTranslatorDependencyProvider::CLIENT_STORAGE);
    }
}
