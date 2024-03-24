<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator\Translator\StorageKeyBuilder;

use Generated\Shared\Transfer\AiTranslatorRequestTransfer;

class StorageKeyBuilder implements StorageKeyBuilderInterface
{
    /**
     * @var string
     */
    protected const KEY_PATTERN = 'ai_translator:%s:%s';

    /**
     * @param \Generated\Shared\Transfer\AiTranslatorRequestTransfer $aiTranslatorRequestTransfer
     *
     * @return string
     */
    public function buildStorageKey(AiTranslatorRequestTransfer $aiTranslatorRequestTransfer): string
    {
        return sprintf(
            static::KEY_PATTERN,
            md5($aiTranslatorRequestTransfer->getTextOrFail()),
            $aiTranslatorRequestTransfer->getTargetLocaleOrFail(),
        );
    }
}
