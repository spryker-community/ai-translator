<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator\Translator;

use Spryker\Client\Storage\StorageClientInterface;
use SprykerCommunity\Client\AiTranslator\AiTranslatorConfig;
use SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface;
use SprykerCommunity\Client\AiTranslator\Translator\StorageKeyBuilder\StorageKeyBuilder;
use SprykerCommunity\Client\AiTranslator\Translator\StorageKeyBuilder\StorageKeyBuilderInterface;

class TranslatorBuilder implements TranslatorBuilderInterface
{
    /**
     * @var \SprykerCommunity\Client\AiTranslator\AiTranslatorConfig
     */
    protected AiTranslatorConfig $config;

    /**
     * @var \Spryker\Client\Storage\StorageClientInterface
     */
    protected StorageClientInterface $storageClient;

    /**
     * @var \SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface
     */
    protected TranslatorEnginePluginInterface $translatorEnginePlugin;

    /**
     * @param \SprykerCommunity\Client\AiTranslator\AiTranslatorConfig $config
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     * @param \SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface $translatorEnginePlugin
     */
    public function __construct(
        AiTranslatorConfig $config,
        StorageClientInterface $storageClient,
        TranslatorEnginePluginInterface $translatorEnginePlugin
    ) {
        $this->config = $config;
        $this->storageClient = $storageClient;
        $this->translatorEnginePlugin = $translatorEnginePlugin;
    }

    /**
     * @return \SprykerCommunity\Client\AiTranslator\Translator\TranslatorInterface
     */
    public function buildTranslator(): TranslatorInterface
    {
        if ($this->config->isCacheEnabled()) {
            return $this->buildTranslatorCacheAware();
        }

        return $this->buildSimpleTranslator();
    }

    /**
     * @return \SprykerCommunity\Client\AiTranslator\Translator\TranslatorInterface
     */
    protected function buildSimpleTranslator(): TranslatorInterface
    {
        return new Translator(
            $this->translatorEnginePlugin,
            $this->config,
        );
    }

    /**
     * @return \SprykerCommunity\Client\AiTranslator\Translator\TranslatorInterface
     */
    protected function buildTranslatorCacheAware(): TranslatorInterface
    {
        return new TranslatorCacheAware(
            $this->buildSimpleTranslator(),
            $this->storageClient,
            $this->createStorageKeyBuilder(),
        );
    }

    /**
     * @return \SprykerCommunity\Client\AiTranslator\Translator\StorageKeyBuilder\StorageKeyBuilderInterface
     */
    protected function createStorageKeyBuilder(): StorageKeyBuilderInterface
    {
        return new StorageKeyBuilder();
    }
}
