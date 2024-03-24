<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Storage\StorageClientInterface;
use SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface;
use SprykerCommunity\Client\AiTranslator\Exception\MissingAiTranslatorEngineException;

class AiTranslatorDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGIN_TRANSLATOR_ENGINE = 'PLUGIN_TRANSLATOR_ENGINE';

    /**
     * @var string
     */
    public const CLIENT_STORAGE = 'CLIENT_STORAGE';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addTranslatorEnginePlugin($container);
        $container = $this->addStorageClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addTranslatorEnginePlugin(Container $container): Container
    {
        $container->set(static::PLUGIN_TRANSLATOR_ENGINE, function (Container $container): TranslatorEnginePluginInterface {
            return $this->getTranslatorEnginePlugin();
        });

        return $container;
    }

    /**
     * @throws \SprykerCommunity\Client\AiTranslator\Exception\MissingAiTranslatorEngineException
     *
     * @return \SprykerCommunity\Client\AiTranslator\Dependency\Plugin\TranslatorEnginePluginInterface
     */
    protected function getTranslatorEnginePlugin(): TranslatorEnginePluginInterface
    {
        throw new MissingAiTranslatorEngineException(
            'Please configure AI translation engine.',
        );
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_STORAGE, function (Container $container): StorageClientInterface {
            return $container->getLocator()->storage()->client();
        });

        return $container;
    }
}
