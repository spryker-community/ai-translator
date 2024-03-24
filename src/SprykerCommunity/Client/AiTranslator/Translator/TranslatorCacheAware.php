<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator\Translator;

use Generated\Shared\Transfer\AiTranslatorRequestTransfer;
use Generated\Shared\Transfer\AiTranslatorResponseTransfer;
use Spryker\Client\Storage\StorageClientInterface;
use SprykerCommunity\Client\AiTranslator\Translator\StorageKeyBuilder\StorageKeyBuilderInterface;

class TranslatorCacheAware implements TranslatorInterface
{
    /**
     * @var \SprykerCommunity\Client\AiTranslator\Translator\TranslatorInterface
     */
    protected TranslatorInterface $translator;

    /**
     * @var \Spryker\Client\Storage\StorageClientInterface
     */
    protected StorageClientInterface $storageClient;

    /**
     * @var \SprykerCommunity\Client\AiTranslator\Translator\StorageKeyBuilder\StorageKeyBuilderInterface
     */
    protected StorageKeyBuilderInterface $storageKeyBuilder;

    /**
     * @param \SprykerCommunity\Client\AiTranslator\Translator\TranslatorInterface $translator
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     * @param \SprykerCommunity\Client\AiTranslator\Translator\StorageKeyBuilder\StorageKeyBuilderInterface $storageKeyBuilder
     */
    public function __construct(
        TranslatorInterface $translator,
        StorageClientInterface $storageClient,
        StorageKeyBuilderInterface $storageKeyBuilder
    ) {
        $this->translator = $translator;
        $this->storageClient = $storageClient;
        $this->storageKeyBuilder = $storageKeyBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\AiTranslatorRequestTransfer $aiTranslatorRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AiTranslatorResponseTransfer
     */
    public function translate(AiTranslatorRequestTransfer $aiTranslatorRequestTransfer): AiTranslatorResponseTransfer
    {
        $cacheKey = $this->storageKeyBuilder->buildStorageKey($aiTranslatorRequestTransfer);
        if (!$aiTranslatorRequestTransfer->getInvalidateCache()) {
            $cachedData = $this->storageClient->get($cacheKey);

            if ($cachedData !== null) {
                return (new AiTranslatorResponseTransfer())->fromArray($cachedData);
            }
        }

        $aiTranslatorResponseTransfer = $this->translator->translate($aiTranslatorRequestTransfer);
        $this->storageClient->set($cacheKey, json_encode($aiTranslatorResponseTransfer->toArray()));

        return $aiTranslatorResponseTransfer;
    }
}
